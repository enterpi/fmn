<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendEmail
 *
 * @author RAJU
 */
class User_friends_Occasions 
{

  public function getUser_friends_Occasions($ip_array)
  {
			$ocasion_date = date('Y').'-'.$ip_array['p_month'];		
			$sql = "select user_occ_id,occasion_name,occasion_date,occasion_day,remind_date,profile_img_path from (
			select uf.id as user_occ_id,concat(uf.first_name,' ',UPPER(SUBSTRING(uf.last_name, 1, 1) ),'\'s ',o.occasion) as occasion_name,
			DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%M %d') as occasion_date,
			DATE_FORMAT(uf.remind_date,'%m/%d/%Y') as remind_date,
			DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%d') as occasion_day,
			profile_img_path
			from 
			user_friends uf
			left join occasions o on o.id = uf.occasion_id
			where DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%m') = ".$ip_array['p_month']." 
			and uf.users_id = ".$ip_array['user_id']."
			and o.occasion_type=1 and uf.hide_occ='n'
			union
			select uf.id as user_occ_id,concat(uf.first_name,' ',UPPER(SUBSTRING(uf.last_name, 1, 1) ),'\'s ',o.occasion) as occasion_name,
			DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%M %d') as occasion_date,
			DATE_FORMAT(uf.remind_date,'%m/%d/%Y') as remind_date,
			DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%d') as occasion_day,
			profile_img_path
			from 
			user_friends uf
			left join occasions o on o.id = uf.occasion_id
			where DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%Y-%m') = ".$ocasion_date." 
			and uf.users_id = ".$ip_array['user_id']."
			and o.occasion_type=2 and uf.hide_occ='n'
			) result_set order by  occasion_day";
		
			//echo $sql;die;
			$friends_occasions = Yii::app()->db->createCommand($sql)->queryAll();
			//echo '<pre>';print_r($friends_occasions); die;
			return $friends_occasions;
			
  }
  public function getUser_friends_Notifications($ip_array)
  {
			
			$sql = "select user_occ_id,occasion_name,occasion_date,occasion_day,remind_date,profile_img_path from (
			select uf.id as user_occ_id,concat(uf.first_name,' ',UPPER(SUBSTRING(uf.last_name, 1, 1) ),'\'s ',o.occasion) as occasion_name,
			DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%M %d') as occasion_date,
			DATE_FORMAT(uf.remind_date,'%m/%d/%Y') as remind_date,
			DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%d') as occasion_day,
			profile_img_path
			from 
			user_friends uf
			left join occasions o on o.id = uf.occasion_id
			where ((DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%m-%d') between '".$ip_array['to_day_repitive']."' and 
					'".$ip_array['notification_date_repitive']."') 
                    or (uf.`remind_date` != '0000-00-00' and uf.remind_date > '".$ip_array['to_day']."' ))
			and uf.users_id = ".$ip_array['user_id']."
			and o.occasion_type=1 
			union
			select uf.id as user_occ_id,concat(uf.first_name,' ',UPPER(SUBSTRING(uf.last_name, 1, 1) ),'\'s ',o.occasion) as occasion_name,
			DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%M %d') as occasion_date,
			DATE_FORMAT(uf.remind_date,'%m/%d/%Y') as remind_date,
			DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%d') as occasion_day,
			profile_img_path
			from 
			user_friends uf
			left join occasions o on o.id = uf.occasion_id
			where ((DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%Y-%m-%d') between '".$ip_array['to_day']."' and 
					'".$ip_array['notification_date']."') 
                    or (uf.`remind_date` != '0000-00-00' and uf.remind_date > '".$ip_array['to_day']."' ))
			and uf.users_id = ".$ip_array['user_id']."
			and o.occasion_type=2 
			) result_set order by  occasion_day";
		
			//echo $sql; die;
			$friends_notifications = Yii::app()->db->createCommand($sql)->queryAll();
			//echo '<pre>';print_r($friends_occasions); die;
			return $friends_notifications;
			
  }

	public function setReminderDate($ip_array)
	{
		$user = UserFriends::model()->findByPk($ip_array['occ_id']);
		$user->remind_date = $ip_array['remind_date'];
		return $user->save();
	}
	public function getReminder_Occasions($ip_array)
	{
		$sql = "SELECT CONCAT(uf.first_name,' ',uf.last_name) as friend_name, 
				uf.occasion_date as occasion_date,uf.profile_img_path,
				DATE_FORMAT(STR_TO_DATE(uf.occasion_date, '%m/%d/%Y'), '%m/%d') as occa_date,
				u.email_address,u.id,
				o.occasion as occasion_name 
				from 
				user_friends uf 
				left join occasions o on o.id = uf.occasion_id 
				left join users u on u.id = uf.users_id 
				where uf.remind_date = '".$ip_array['to_date']."' order by occa_date,friend_name";
		
		$reminder_Occasions = Yii::app()->db->createCommand($sql)->queryAll();
			//echo '<pre>';print_r($friends_occasions); die;
		return $reminder_Occasions;
				
	}
  
    //put your code here
}
?>

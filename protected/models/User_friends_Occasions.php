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

  function getUser_friends_Occasions($ip_array)
  {
			$ocasion_date = date('Y').'-'.$ip_array['p_month'];		
			$sql = "select user_occ_id,occasion_name,occasion_date,occasion_day,remind_date from (
			select uo.id as user_occ_id,concat(u.first_name,' ',u.last_name,'\'s ',o.occasion) as occasion_name,
			DATE_FORMAT(uo.occasion_date, '%M %d') as occasion_date,DATE_FORMAT(uo.remind_date,'%m/%d/%Y') as remind_date,
			DATE_FORMAT(uo.occasion_date, '%d') as occasion_day 
			from 
			users_occasions uo
			left join users u on u.id = uo.users_id
			left join users_friends uf on uf.users_friend_id = u.id 
			left join occasions o on o.id = uo.occasions_id
			where DATE_FORMAT(uo.occasion_date, '%m') = ".$ip_array['p_month']." 
			and uf.users_id = ".$ip_array['user_id']."
			and o.occasion_type=1 and uo.hide_occ='n'
			union
			select uo.id as user_occ_id,concat(u.first_name,' ',u.last_name,'\'s ',o.occasion) as occasion_name,
			DATE_FORMAT(uo.occasion_date, '%M %d') as occasion_date,DATE_FORMAT(uo.remind_date,'%m/%d/%Y') as remind_date,
			DATE_FORMAT(uo.occasion_date, '%d') as occasion_day 
			from 
			users_occasions uo
			left join users u on u.id = uo.users_id
			left join users_friends uf on uf.users_friend_id = u.id 
			left join occasions o on o.id = uo.occasions_id
			where DATE_FORMAT(uo.occasion_date, '%Y-%m') = '".$ocasion_date."' 
			and uf.users_id = ".$ip_array['user_id']." 
			and o.occasion_type=2  and uo.hide_occ='n'
			) result_set order by  occasion_day";
		
			//echo $sql;
			$friends_occasions = Yii::app()->db->createCommand($sql)->queryAll();
			//echo '<pre>';print_r($friends_occasions); die;
			return $friends_occasions;
			
  }
  function getUser_friends_Notifications($ip_array)
  {
      //print_r($ip_array);die;
			$sql = "select occasion_name,occasion_date,occasion_day from (				
			select concat(u.first_name,' ',u.last_name,'\'s ',o.occasion) as occasion_name,
			DATE_FORMAT(uo.occasion_date, '%M %d') as occasion_date,
			uo.occasion_date as occasion_day 
			from 
			users_occasions uo
			left join users u on u.id = uo.users_id
			left join users_friends uf on uf.users_friend_id = u.id 
			left join occasions o on o.id = uo.occasions_id
			where ((uo.occasion_date between '".$ip_array['to_day']."' and '".$ip_array['notification_date']."') 
                                or (uo.`remind_date` != '0000-00-00' and uo.remind_date > '".$ip_array['to_day']."' ))
			and uf.users_id = ".$ip_array['user_id']."
			and o.occasion_type=1
			union
			select concat(u.first_name,' ',u.last_name,'\'s ',o.occasion) as occasion_name,
			DATE_FORMAT(uo.occasion_date, '%M %d') as occasion_date,
			uo.occasion_date as occasion_day  
			from 
			users_occasions uo
			left join users u on u.id = uo.users_id
			left join users_friends uf on uf.users_friend_id = u.id 
			left join occasions o on o.id = uo.occasions_id
			where ((uo.occasion_date between '".$ip_array['to_day']."' and '".$ip_array['notification_date']."') 
                                or (uo.`remind_date` != '0000-00-00' and uo.remind_date > '".$ip_array['to_day']."' ))
			and uf.users_id = ".$ip_array['user_id']." 
			and o.occasion_type=2
			) result_set order by  occasion_day";
		
			//echo $sql;
			$friends_notifications = Yii::app()->db->createCommand($sql)->queryAll();
			//echo '<pre>';print_r($friends_occasions); die;
			return $friends_notifications;
			
  }

  function setReminderDate($ip_array)
  {
        $user = UsersOccasions::model()->findByPk($ip_array['occ_id']);
        $user->remind_date = $ip_array['remind_date'];
        return $user->save();
  }
    //put your code here
}
?>

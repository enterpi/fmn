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
			$sql = "select occasion_name,occasion_date,occasion_day from (				
			select concat(u.first_name,' ',u.last_name,'\'s ',o.occassion) as occasion_name,
			DATE_FORMAT(uo.occassion_date, '%M %d') as occasion_date,
			uo.occassion_date as occasion_day 
			from 
			users_occassions uo
			left join users u on u.id = uo.users_id
			left join users_friends uf on uf.users_friend_id = u.id 
			left join occassions o on o.id = uo.occassions_id
			where DATE_FORMAT(uo.occassion_date, '%m') = ".$ip_array['p_month']." 
			and uf.users_id = ".$ip_array['user_id']."
			and o.occassion_type=1
			union
			select concat(u.first_name,' ',u.last_name,'\'s ',o.occassion) as occasion_name,
			DATE_FORMAT(uo.occassion_date, '%M %d') as occasion_date,
			uo.occassion_date as occasion_day 
			from 
			users_occassions uo
			left join users u on u.id = uo.users_id
			left join users_friends uf on uf.users_friend_id = u.id 
			left join occassions o on o.id = uo.occassions_id
			where DATE_FORMAT(uo.occassion_date, '%Y-%m') = '".$ocasion_date."' 
			and uf.users_id = ".$ip_array['user_id']." 
			and o.occassion_type=2
			) result_set order by  occasion_day";
		
			//echo $sql;
			$friends_occasions = Yii::app()->db->createCommand($sql)->queryAll();
			//echo '<pre>';print_r($friends_occasions); die;
			return $friends_occasions;
			
  }
  function getUser_friends_Notifications($ip_array)
  {
			$sql = "select occasion_name,occasion_date,occasion_day from (				
			select concat(u.first_name,' ',u.last_name,'\'s ',o.occassion) as occasion_name,
			DATE_FORMAT(uo.occassion_date, '%M %d') as occasion_date,
			uo.occassion_date as occasion_day 
			from 
			users_occassions uo
			left join users u on u.id = uo.users_id
			left join users_friends uf on uf.users_friend_id = u.id 
			left join occassions o on o.id = uo.occassions_id
			where uo.occassion_date between '".$ip_array['to_day']."' and '".$ip_array['notification_date']."' 
			and uf.users_id = ".$ip_array['user_id']."
			and o.occassion_type=1
			union
			select concat(u.first_name,' ',u.last_name,'\'s ',o.occassion) as occasion_name,
			DATE_FORMAT(uo.occassion_date, '%M %d') as occasion_date,
			uo.occassion_date as occasion_day  
			from 
			users_occassions uo
			left join users u on u.id = uo.users_id
			left join users_friends uf on uf.users_friend_id = u.id 
			left join occassions o on o.id = uo.occassions_id
			where uo.occassion_date between '".$ip_array['to_day']."' and '".$ip_array['notification_date']."' 
			and uf.users_id = ".$ip_array['user_id']." 
			and o.occassion_type=2
			) result_set order by  occasion_day";
		
			//echo $sql;
			$friends_notifications = Yii::app()->db->createCommand($sql)->queryAll();
			//echo '<pre>';print_r($friends_occasions); die;
			return $friends_notifications;
			
  }
    //put your code here
}
?>

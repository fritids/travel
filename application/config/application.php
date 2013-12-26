<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**********URL FOR HEADER****************/
$config['login_url'] = "users/login";
$config['logout_url'] = "users/logout";
$config['passrecover_url'] = "users/recover";
$config['invitation_url'] = "users/invitation";
$config['signup_url'] = "users/signup/tourist";
$config['hotel_owner_signup_url'] = "users/signup/hotel-owner/beta";
$config['tourist_offer_signup_url'] = "users/signup/tourist-office";

$config['dashboard_url'] = "dashboard";
$config['dashboard_account_url'] = "dashboard/account";
$config['dashboard_lastminute_url'] = "dashboard/offers";
$config['save_struttura_url'] = "profile/save_struttura";
$config['save_descrizione_url'] = "profile/save_descrizione";
$config['save_servizi_url'] = "profile/save_servizi";
$config['save_altro_url'] = "profile/save_altro";
$config['save_attachment_url'] = "profile/save_attachment";

$config['user_profile_edit_url'] = "profile/edit";
$config['user_profile_profilo_edit_url'] = "profile/edit";
$config['user_profile_descrizione_edit_url'] = "profile/edit/descrizione";
$config['user_profile_servizi_edit_url'] = "profile/edit/servizi";
$config['user_profile_distanze_edit_url'] = "profile/edit/distanze";
$config['user_profile_immagini_edit_url'] = "profile/edit/immagini";


$config['account_profile_edit_url'] = "dashboard/account";

$config['user_comments_url'] = "comments/%username%";
$config['user_profile_payment_edit_url'] = "profile/save_payment_profile";
$config['save_hotel_profile_data_url'] = "profile/save_hotel_profile";
$config['user_profile_account_setting_url'] = "profile/save_account_profile";


$config['messages_url'] = "messages";
$config['payment_bills_url'] = "payment/settings";


$config['create_new_offer_url'] = "offers/create";
$config['offers_edit_url'] = "offers/edit/%id%";
$config['offers_cancel_url'] = "offers/cancel/%id%";
$config['offers_detail_url'] = "offers/%id%";

$config['subscribe_credit_url'] = "account/recharge";

$config['create_new_comments_url'] = "comments/create";

$config['hotel_detail_url'] = "hotels/%id%";

$config['lastminute_page_url'] = "offers/page/1";
$config['search_page_url'] = "search";
$config['hotel_page_url'] = "hotels";

$config['newsletter_url'] = "newsletter";
$config['feedback_url'] = "feedback";
$config['favorites_url'] = "#";
$config['blog_url'] = "blog";
$config['faq_url'] = "faq";

$config['twitterlogin_url'] = "login/twitter";
$config['facebooklogin_url'] = "login/facebook";
$config['signup_with_facebook_url'] = "users/signup_with_facebook";

$config['about_page_url'] = "about-us";
$config['jobs_page_url'] = "jobs";
$config['support_page_url'] = "support";
$config['contact_page_url'] = "contact";
$config['how_it_work_page_url'] = "how-it-works";
$config['how_it_work_page_for_tourist_url'] = "how-it-works-tourist";
$config['how_it_work_page_for_hotel_owner_url'] = "how-it-works-hotel-owner";
$config['how_it_work_page_for_tourist_office_url'] = "how-it-works-tourist-office";
$config['get_started_page_url'] = "get-started";
$config['conditions_page_url'] = "terms-and-conditions";
$config['privacy_page_url'] = "privacy-policy";


$config['offers_seo_title'] = "%offer_title% - %hotel_name% - %city%";
$config['hotel_seo_title'] = "%hotel_type% a %city% - %hotel_name%";

$config['default_country'] = 14;
?>
<?php
/*Front end view of team information shortcode
==================================*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



$post_output = '<div class="team-single-info equal-heighter '.$tinfo_style.'">';

$position = get_post_meta(get_the_ID(), 'blokco_staff_position', true);
$facebook = get_post_meta(get_the_ID(), 'blokco_staff_member_facebook', true);
$twitter = get_post_meta(get_the_ID(), 'blokco_staff_member_twitter', true);
$gplus = get_post_meta(get_the_ID(), 'blokco_staff_member_gplus', true);
$linkedin = get_post_meta(get_the_ID(), 'blokco_staff_member_linkedin', true);
$pinterest = get_post_meta(get_the_ID(), 'blokco_staff_member_pinterest', true);
$email = get_post_meta(get_the_ID(), 'blokco_staff_member_email', true);
$phone = get_post_meta(get_the_ID(), 'blokco_staff_member_phone', true);
$address = get_post_meta(get_the_ID(), 'blokco_staff_member_address', true);
$social = '';
$social_data = array();
$social_data = array('facebook'=>$facebook, 'twitter'=>$twitter, 'google-plus'=>$gplus, 'linkedin'=>$linkedin, 'pinterest'=>$pinterest);
if($facebook!=''||$twitter!=''||$gplus!=''||$linkedin!=''||$pinterest!='')
{
	$social .= '<ul class="imi-social-icons imi-social-icons-medium imi-social-icons-round imi-social-icons-sc imi-social-icons-hover-tc">';
	foreach($social_data as $key=>$value)
	{
		if($value!='')
		{
			$url = $value;
			$social .= '<li class="'.esc_attr($key).'"><a href="'.esc_url($url).'">
						  <i class="fa fa-'.esc_attr($key).'"></i>
					  </a></li>';
		}
	}
	$social .= '</ul>';
}
if($tinfo_address && $address != ''){
	$post_output .= '<div class="tinfo-block equal-height-column">';
	$post_output .= '<div class="icon-box  ibox-outline ibox-icon-48 ibox-plain"><div class="ibox-icon accent-color"><i class="fa fa-map-marker"></i></div><h3>'.esc_html('Postal address','blokco').'</h3><p class="">'.$address.'</p></div>';
	$post_output .= '</div>';
}
if(($tinfo_email || $tinfo_phone) && ($email != '' || $phone != '')){
	$post_output .= '<div class="tinfo-block equal-height-column">';
	$post_output .= '<div class="icon-box  ibox-outline ibox-icon-48 ibox-plain"><div class="ibox-icon accent-color"><i class="fa fa-id-card"></i></div><h3>'.esc_html('Contact Info','blokco').'</h3><p class="">';
	if($email != ''){
		$post_output .= '<p><a href="mailto:'.$email.'">'.$email.'</a></p>';
	}
	if($phone != ''){
		$post_output .= '<p><a href="tel:'.$phone.'">'.$phone.'</a></p>';
	}
	$post_output .= '</div></div>';
}
if($tinfo_social || $social != array()){
	$post_output .= '<div class="tinfo-block equal-height-column">';
	$post_output .= '<h3>'.esc_html('Social Profiles','blokco').'</h3>';
	$post_output .= $social;
	$post_output .= '</div>';
}
$post_output .= '</div>';
global $blokco_allowed_tags;
echo wp_kses($post_output, $blokco_allowed_tags);
?>
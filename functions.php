<?php
/**
 * fiat functions and definitions
 *
 * @package fiat
 * @since fiat 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since fiat 1.0
 */

$template_directory = get_template_directory();

$template_directory_uri = get_template_directory_uri();


add_action( 'wp_enqueue_scripts', 'custom_scripts', 50);

add_action( 'wp_print_styles', 'custom_styles', 30);


if ( ! function_exists( 'fiat_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since fiat 1.0
 */
function fiat_setup() {

	require( get_template_directory() . '/inc/classes/bfi-thumb.php' );

	require( get_template_directory() . '/inc/shortcodes.php' );

	register_nav_menus( array(
		'primary_header' => __( 'Primary Header Menu', 'ivip' )
	) );

	add_editor_style('css/editor-styles.css');
	
}
endif; // fiat_setup
add_action( 'after_setup_theme', 'fiat_setup' );

function custom_scripts() {
	global $template_directory_uri;

	
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', $template_directory_uri.'/js/libs/modernizr.min.js');
	wp_enqueue_script('owlcarousel', $template_directory_uri.'/js/plugins/jquery.owlcarousel.js', array('jquery'), '', true);
	wp_enqueue_script('easing', get_template_directory_uri().'/js/plugins/jquery.easing.js');
	wp_enqueue_script('actual', get_template_directory_uri().'/js/plugins/jquery.actual.js', array('jquery'), '', true);		
	wp_enqueue_script('selecter', get_template_directory_uri().'/js/plugins/jquery.fs.selecter.min.js');
	wp_enqueue_script('main', get_template_directory_uri().'/js/main.js');	
}


function custom_styles() {
	global $wp_styles, $template_directory_uri;

	wp_enqueue_style( 'style', $template_directory_uri . '/css/style.css' );	
	wp_enqueue_style( 'fonts', '//fast.fonts.net/cssapi/0513edcc-1270-4163-b2a9-7f909888318d.css' );	
}


add_action('tiny_mce_before_init', 'custom_tinymce_options');
if ( ! function_exists( 'custom_tinymce_options' )) {
	function custom_tinymce_options($init){
		$init['apply_source_formatting'] = true;
		return $init;
	}
}

if( function_exists('acf_add_options_page') ) acf_add_options_page();	

add_image_size( 'header_image', 630, 323, true);

add_action("gform_field_standard_settings", "custom_gform_standard_settings", 10, 2);
function custom_gform_standard_settings($position, $form_id){
    if($position == 25){
    	?>
        <li style="display: list-item; ">
            <label for="field_placeholder">Placeholder Text</label>
            <input type="text" id="field_placeholder" size="35" onkeyup="SetFieldProperty('placeholder', this.value);">
        </li>
        <?php
    }
}

//add_action('gform_enqueue_scripts',"custom_gform_enqueue_scripts", 10, 2);
function custom_gform_enqueue_scripts($form, $is_ajax=false){
    ?>
<script>
    jQuery(function(){
        <?php
        foreach($form['fields'] as $i=>$field){
            if(isset($field['placeholder']) && !empty($field['placeholder'])){
                ?>
                jQuery('#input_<?php echo $form['id']?>_<?php echo $field['id']?>').attr('placeholder','<?php echo $field['placeholder']?>');
                <?php
            }
        }
        ?>
    });
    </script>
    <?php
}

add_action('gform_after_submission', 'generate_xml', 10, 2);
function generate_xml($entry, $form) {

	$xml_string = '<?xml version="1.0" encoding="UTF-8"?>
	<TestDriveBookingsFiat>
		<TestDriveBookingFiat>
			<UniqueFormID>'.$entry['id'].'</UniqueFormID>
			<Title>'.$entry['2'].'</Title>
			<FirstName>'.$entry['3'].'</FirstName>
			<LastName>'.$entry['4'].'</LastName>
			<Companyname>'.$entry['6'].'</Companyname>
			<CompanyAddress1>'.$entry['7'].'</CompanyAddress1>
			<CompanyAddress2>'.$entry['8'].'</CompanyAddress2>
			<CompanyAddress3>'.$entry['9'].'</CompanyAddress3>
			<CompanyAddress4>'.$entry['10'].'</CompanyAddress4>
			<CompanyPostCode>'.$entry['11'].'</CompanyPostCode>
			<EmailAddress>'.$entry['21'].'</EmailAddress>
			<TelephoneNumber>'.$entry['13'].'</TelephoneNumber>
			<MobileNumber>'.$entry['14'].'</MobileNumber>
			<Model>'.$entry['15'].'</Model>
			<FuelType>'.$entry['16'].'</FuelType>
			<CurrentCarRegistrationNumber>'.$entry['18'].'</CurrentCarRegistrationNumber>
			<UseOfDataPost>'.$entry['23.1'].'</UseOfDataPost>
			<UseOfDataTelephone>'.$entry['23.2'].'</UseOfDataTelephone>
			<UseOfDataEmail>'.$entry['23.3'].'</UseOfDataEmail>
			<UseOfDataSMS>'.$entry['23.4'].'</UseOfDataSMS>
			<OfficeUseOnlyEmail>'.$entry['24'].'</OfficeUseOnlyEmail>
			<CustomerCode>'.$entry['25'].'</CustomerCode>
		</TestDriveBookingFiat>
	</TestDriveBookingsFiat>
	';

	// return $xml_string;
	$xml_string = str_replace('&', '&amp;', $xml_string);

	$uploads = wp_upload_dir();
	$location = $uploads['basedir'].'/bookings/entry_'.$entry['id'].'.xml';
	$xml = new SimpleXMLElement($xml_string);
	$xml->asXml($location);

	$xml_file = fopen($location, 'r');
	
	$curl = curl_init();
 	curl_setopt($curl, CURLOPT_URL, 'ftp://Fiat:34Solution@176.35.225.193/WebEnquiry/entry_'.$entry['id'].'.xml');
 	curl_setopt($curl, CURLOPT_UPLOAD, 1);
 	curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml")); 
 	curl_setopt($curl, CURLOPT_PUT, 1);
 	curl_setopt($curl, CURLOPT_INFILESIZE, filesize($location));
 	curl_setopt($curl, CURLOPT_INFILE, $xml_file);

 	$result = curl_exec($curl);
 	$error_no = curl_errno($curl);
 	curl_close($curl);


	// // Uploading files to Booking system FTP at SiSo
	// $credentials = array(
	//         'sisofiatdata14',
	//         'hibhg0zon!$'
	// );
	// $remoteurl = 'https://fiat.siso.co/data_uploads/';
	// $filename = 'entry_'.$entry['id'].'.xml';


 //    if(is_readable($location)){
 //                    $filesize = filesize($location);
 //                    $fh = fopen($location, 'rb');
                   
 //                    $ch = curl_init($remoteurl);
                   
 //                    // Set the authentication mode and login credentials
 //                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	// 				curl_setopt($ch, CURLOPT_USERPWD, implode(':', $credentials));                    
                   
 //                    // Execute the request, upload the file
 //                    curl_setopt($ch, CURLOPT_URL, $remoteurl.$filename);
                   
 //                    // Define that we are going to upload a file, by setting CURLOPT_PUT we are
 //                    // forced to set CURLOPT_INFILE and CURLOPT_INFILESIZE as well.
 //                    curl_setopt($ch, CURLOPT_PUT, true);
                   
 //                    curl_setopt($ch, CURLOPT_INFILE, $fh);
                   
 //                    curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
                   
 //                    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // --data-binary
                   
 //                    // Execute the request, upload the file
 //                    $success = curl_exec($ch);
                   
 //                    // Close the file handle
 //                    fclose($fh);
                   
 //                    return ($success)?"Uploaded":"Error: ".curl_error($ch);               
 //    }else{
 //                    return "File cannot be opened";
 //    }	    
}

if(!function_exists('get_post_thumbnail_src')) {
	function get_post_thumbnail_src($size = 'thumbnail'){
		global $post;
		$thumbnail_id = get_post_thumbnail_id();
		return get_image($thumbnail_id, $size);
	}
}

if(!function_exists('get_image')) {
	function get_image($id, $size = 'thumbnail'){
		
		if( is_array($size) ) $size['bfi_thumb'] = true;

		$image = wp_get_attachment_image_src($id, $size);

		if( !empty($image[0]) ) return $image[0];
		return;
	}
}
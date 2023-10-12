<?php
/**
 * @author - Dennis Otieno
 * @param Date - 15-01-2023
 * @param Description - Mpesa Configuration files key and secret
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$ci =& get_instance();
$ci->load->database();

// Get Mpesa configuration files from database
$ci->db->select('*');
$ci->db->from('mpesa_settings');
$ci->db->where('id', 1);
$query = $ci->db->get()->row();

	$BusinessShortCode = $query->businessShortCode;
	$PartyB = $query->partyB;
	$AccountReference = $query->accountReference;
	$PassKey = $query->passKey;
	$ConsumerKey = $query->ConsumerKey;
	$SecretKey = $query->SecretKey;


$config = array(
	'consumer_key' => $ConsumerKey,
	'consumer_secret' => $SecretKey,
	'partyB' => $PartyB,
	'businessSortCode' => $BusinessShortCode,
	'passKey' => $PassKey,
	'accountReference' => $AccountReference,
);

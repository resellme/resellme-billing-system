<?php
use Resellme\Client;

function hasEnoughFunds() {
	return true;
}

function rmClient() {
	 // Get Token
    $token = env('RESELLME_TOKEN');
    
    // Create RM client
    $client = new Client($token);

    return $client;
}
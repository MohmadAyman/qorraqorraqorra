<?php
/*
 Template Name: Logout_Page
 */
 session_start();
   
   if(session_destroy()) {
      header("Location: home");
   }
 get_header();
?>   
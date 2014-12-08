<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About TOS CLOUD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        TOS CLOUD is a small project created during Koding Hakathon.
    </p>
    
    <p>
        This project is created to enable people to rate and discuss web services legal documents like (Terms of service, Privacy Policy, etc..)
    </p>
    
    <h2>
        How it Works?
    </h2>
    
    <ol>
        <li>Click on Create Button</li>
        <li>Enter service name and select legal document type</li>
        <li>Copy and paste legal document text to text field</li>
        <li>start rating and discussing of each part of the text</li>
    </ol>
    
    <h2>
    What is Next?
    </h2>
    
    <ol>
        <li>Search is not working :) will be soon</li>
        <li>Full rating and sorting of services according to user rates</li>
        <li>Social Share</li>
    </ol>

    <h2>
        About Me
    </h2>
    <div style="float:left">
    <img src="https://gravatar.com/avatar/7a7dd4c6cf540f4cc874ee13bbf71bdd?size=143" style="border-radius: 350px;"/>
    </div>
    <div style="float:left;padding: 45px;">
    
        I am Moemen Mostafa From Cairo-Egypt, a web developer that loves to code and discover new technologies. <br>My main domain is PHP and I am learning other Languages currently.
    </div>

</div>
<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');

$url = $_SERVER['HTTP_HOST'];
$pos = strpos($url, '.');
$uploads = 'http://'.substr($url, $pos + 1);

Yii::setAlias('@images', $uploads . '/uploads');

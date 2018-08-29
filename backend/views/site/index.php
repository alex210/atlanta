<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="/journals">Журналы</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/authors">Авторы</a>
                    </li>
                </ul>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>Описание</td>
                            <td>Адрес</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>GET - получение списка журналов с данными авторов</th>
                            <th><?=Url::home(true)?>rest</th>
                        </tr>
                        <tr>
                            <th>GET - получение информации о журнале по id</th>
                            <th><?=Url::home(true)?>rest/id</th>
                        </tr>
                        <tr>
                            <th>PUT - обновление дынных журнала</th>
                            <th><?=Url::home(true)?>rest/id</th>
                        </tr>
                        <tr>
                            <th>DELETE - удаление журнала по id</th>
                            <th><?=Url::home(true)?>rest/id</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

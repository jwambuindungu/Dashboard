<footer class="main-footer">
    <!--<div class="pull-right hidden-xs">
        <?= Yii::powered() ?>
    </div>-->
    <strong>&copy; <?= date('Y') ?> <a href="#">University Of Nairobi</a>.</strong> All rights
    reserved.
</footer>

<style>
    .pulse-btn {
        position: relative;
        border: none;
        box-shadow: 0 0 0 0 rgba(232, 76, 61, 0.7);
        background-size:cover;
        background-repeat: no-repeat;
        cursor: pointer;
        -webkit-animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
        -moz-animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
        -ms-animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
        animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
    }
    .pulse-btn:hover
    {
        -webkit-animation: none;-moz-animation: none;-ms-animation: none;animation: none;
    }
    @-webkit-keyframes pulse {to {box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);}}
    @-moz-keyframes pulse {to {box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);}}
    @-ms-keyframes pulse {to {box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);}}
    @keyframes pulse {to {box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);}}
</style>
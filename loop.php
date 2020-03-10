<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/03/2020
 * Time: 5:27 PM
 */ ?>

<script type="text/javascript">
    $(document).ready(function () {
        setInterval(function () {
            console.log('execute scan');
            $.ajax({
                url: "<?=('https://test2.estimit.net/~maricris/ptbcsi/push');?>",
                method: 'post',
                dataType: "JSON",
                data: {name: 'john'},
                success: function (response) {
                    console.log(response);
//                    location.reload();
                },
            });
        }, 1000);
//
    });
</script>
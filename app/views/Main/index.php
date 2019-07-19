<div class="container">
    <div id="answer"></div>
    <?php if (!empty($posts)) : ?>
        <?php foreach ($posts as $post) :?>
            <div class="panel panel-default">
                <div class="panel-heading"><?= $post['title']?></div>
                <div class="panel-body">
                    <?php echo html_entity_decode($post['description'])?>
                </div>
                <button class="send btn btn-default" value="<?=$post['id']?>">Button</button>
            </div>

        <?php endforeach;?>
    <?php endif;?>
</div>
<script src="/js/test.js"></script>
<script>
    $('.send').click(function (e) {
        $.ajax({
            url:'/main/test',
            type:'post',
            data:{'id':e.target.value},
            success:function (res) {
                // var data = JSON.parse(res);
                // $('#answer').html('<p>Title:'+ data.name + '| Description: ' + data.description + '</p>');
                $('#answer').html(res);
                // console.log(data)
            },
            error: function () {
                alert("ERROR")
            }
        })
    });
</script>
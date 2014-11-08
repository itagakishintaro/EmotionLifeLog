<!DOCTYPE html>
<html lang='ja'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>感情ライフログ</title>

    <!-- Bootstrap -->
    <?php echo $this->Html->css('bootstrap.min');?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
      <script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
    <![endif]-->

    <?php echo $this->Html->css('ell');?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>

<body>
    <div class='container'>
        <h1>感情ライフログ</h1> 
        <?php echo $this->Form->create('Emotion', array('type' => 'file')); ?>
        <?php	echo $this->Form->input('Emotion.my_emotion', array('type' => 'hidden', 'value' => ''));?> 
        <?php echo $this->Form->input('Emotion.my_emotion_val', array('type' => 'hidden', 'value' => ''));?>  
        <?php	echo $this->Form->input('Emotion.record_date', array('type' => 'hidden', 'value' => date("Y-m-d h:i:s")));?> 
        <?php	echo $this->Form->input('Emotion.img_file', array('type' => 'hidden', 'value' => ''));?> 
        <div class='row'>
            <div class='col-md-6'>
                <h2><span class='label label-info'>今どんな気分？</span></h2>
                <p>メモを書いて、今の感情に近いボタンを押してください。押したら、すぐに登録されます。</p>
                <h3><span class='label label-info'>メモ</span></h3>
<?php echo $this->Form->input('memo', array('class' => 'form-control', 'rows' => '3', 'placeholder' => '空でもいいけど、入れると感情分析結果がみれるよ。'));?>
                <div id='emotion'>
                    <h3>
                        <span class='label label-default'>感情の度合い</span>
                        <span id="show-range">50</span>
                    </h3>
                    <p>※最小が0で最大が100です。</p>
                    <div><input id='range' type='range' min='0' max='100' step='1' onchange='showValue()'  /></div>
                    <button id='happy' type='button' class='btn btn-warning'>Happy</button>
                    <button id='sad' type='button' class='btn btn-primary'>Sad</button>
                    <button id='angry' type='button' class='btn btn-danger'>Angry</button>
                    <button id='fear' type='button' class='btn btn-success'>Fear</button>
                </div>
            </div>
          </form>
          <form>
            <div class="col-md-6">
                                <h2><span class='label label-info'>最近のあなたの感情</span></h2>
                <p>更新ボタンを押すと、最新の状況がみれます。オススメアロマボタンを押すと、オススメアロマが表示されます。</p>
                <button id='output' type='button' class='btn btn-primary'>更新</button>
                <button id='output' type='button' class='btn btn-success'>オススメアロマ</button>
                <hr>
                <h3>割合</h3>
                <div id='pi-self' class='chart'>ここに感情円グラフ(自分のボタン入力)</div>
                <div id='pi-memo' class='dummy-img'>ここに感情円グラフ(メモから解析)</div>
                <div id='pi-image' class='dummy-img'>ここに感情円グラフ(画像から解析)</div>
                <hr>
                <h3>時系列</h3>
                <div id='line-self' class='chart'>ここに感情ラインチャート(自分のボタン入力)</div>
                <div id='line-memo' class='dummy-img'>ここに感情ラインチャート(メモから解析)</div>
                <div id='line-image' class='dummy-img'>ここに感情ラインチャート(画像から解析)</div>
                <hr>
                <h3>感情Max写真</h3>
                <div id='max-happy' class='dummy-img'>ここに感情ラインチャート(自分のボタン入力)</div>
                <div id='max-sad' class='dummy-img'>ここに感情ラインチャート(自分のボタン入力)</div>
                <div id='max-angry' class='dummy-img'>ここに感情ラインチャート(メモから解析)</div>
                <div id='max-fear' class='dummy-img'>ここに感情ラインチャート(画像から解析)</div>
            </div>
</form>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php echo $this->Html->script('jquery-2.1.1.min');?>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php echo $this->Html->script('bootstrap.min');?>
    <?php echo $this->Html->script('ell');?>
<script>
$('#emotion').find('.btn').click(function() {
    var label = $(this).attr('id');
    $('#EmotionMyEmotion').val(label);
    $('#EmotionMyEmotionVal').val($('#show-range').text());
    $('#EmotionImgFile').val();// ここに画像データ入れる
    $('form#EmotionAddForm').submit();
});
</script>
</body>

</html>
<!--

<div class="emotions form">
<?php echo $this->Form->create('Emotion'); ?>
	<fieldset>
		<legend><?php echo __('Add Emotion'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('record_date');
		echo $this->Form->input('my_emotion');
		echo $this->Form->input('my_emotion_val');
		echo $this->Form->input('analyzed_emotion');
		echo $this->Form->input('analyzed_emotion_val');
		echo $this->Form->input('face_emotyion');
		echo $this->Form->input('face_emotyion_val');
		echo $this->Form->input('memo');
		echo $this->Form->input('img1');
		echo $this->Form->input('img_file');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Emotions'), array('action' => 'index')); ?></li>
	</ul>
</div>
-->

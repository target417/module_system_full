<div class="row">
    <h2><?php $message->getAuthor(); ?></h2>
    <div><?php $message->gettext(); ?></div>
    <?php if(!empty($message->answer)) { ?>
        <div><?php $message->getAnswer(); ?></div>
    <?php } ?>
</div>
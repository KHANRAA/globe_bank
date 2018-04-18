<?php require_once('../../../private/initialize.php');?>

<?php
$id=isset($_GET['id']) ? $_GET['id'] : '1';

$subject=find_subject_by_id($id);


?>
<?php $page_title='Show Page';?>
<?php include(SHARED_PATH . '/staff_header.php');?>
<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php');?>">&laquo;Back to List</a>

    <div class="Subject show">
        <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>
        <div class="attributes">
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($subject['menu_name']);?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($subject['position']); ?></dd>

            </dl>
            <dl>
                <dt>Visible</dt>
                <td><?php echo $subject['visible']==1 ? 'true' : 'false';?></td>
            </dl>
        </div>
    </div>

</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
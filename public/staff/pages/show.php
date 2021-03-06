<?php require_once('../../../private/initialize.php');?>
<?php
$id=isset($_GET['id']) ? $_GET['id'] : '1';
$page=find_page_by_id($id);
?>

<?php $page_title='Show Page';?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo;Back to List</a>


        <div class="Page show">
            <h1>Page: <?php echo h($page['menu_name']); ?></h1>
            <div class="attributes">
                <?php $subject=find_subject_by_id($page['subject_id']);?>
                <dl>
                    <dt>Subject </dt>
                    <td><?php echo h($subject['menu_name']);?></td>
                </dl>
                <dl>
                    <dt>Menu Name</dt>
                    <td><?php echo h($page['menu_name']);?></td>

                </dl>
                <dl>
                    <dt>Position</dt>
                    <td><?php echo h($page['position']);?></td>

                </dl>
                <dl>
                    <dt>Visible</dt>
                    <td><?php echo $page['visible']==1 ? 'true' : 'false';?></td>
                </dl>
                <dl>
                    <dt>Content</dt>
                    <td><?php echo h($page['content']);?></td>
                </dl>
            </div>
        </div>

</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
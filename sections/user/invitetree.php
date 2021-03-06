<?php
if (isset($_GET['userid']) && check_perms('users_view_invites')) {
    if (!is_number($_GET['userid'])) {
        error(403);
    }

    $UserID = $_GET['userid'];
    $Sneaky = true;
} else {
    $UserCount = Users::get_enabled_users_count();
    $UserID = $LoggedUser['ID'];
    $Sneaky = false;
}

list($UserID, $Username, $PermissionID) = array_values(Users::user_info($UserID));

include(SERVER_ROOT.'/classes/invite_tree.class.php');
$Tree = new INVITE_TREE($UserID);

View::show_header($Username.' &gt; Invites &gt; Tree');
?>
<div class="thin">
    <div class="header">
        <h2><?=Users::format_username($UserID, false, false, false)?> &gt; <a href="user.php?action=invite&amp;userid=<?=$UserID?>">Invites</a> &gt; Tree</h2>
    </div>
    <div class="box pad">
<?php    $Tree->make_tree(); ?>
    </div>
</div>
<?php
View::show_footer();

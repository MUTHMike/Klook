<!DOCTYPE html>
<html>
    <head>
        <title>Categories Area</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="./css/backend.css" media="screen" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="./js/jquery.js"></script>
        <script type="text/javascript" src="./js/backend.js"></script>
    </head>
    <body>
        <div id="wraper">
            <header id="header">
                <nav class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="row-fluid">
                            <div class="span1 text-right">
                                <a href="member.php" class="btn btn-info" title="Main Admin"><i class="fam-house"></i></a>
                            </div>
                            <div class="span1 text-left">
                                <a href="saveCategory.php" class="btn btn-success" title="Add Category"><i class="fam-application-add"></i></a>
                            </div>
                            <div class="span1 text-right offset8">
                                <a class="btn btn-success" href="./../" target="_blank"><i class="fam-house"></i></a>
                            </div>
                            <div class="span1 text-left">
                                <a class="btn btn-danger" href="logout.php"><i class="icon-off icon-white"></i></a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <?php include ('./views/showSMS.php'); ?>
            <div class="container">
                <div id="content">
                    <div class="row-fluid">
                        <div class="span12 bd-navbar-top" style="background-color: #D6CDC6;">
                            <div id="spin_list" class="navbar navbar-static-top">
                                <div class="navbar-inner">
                                    <div class="brand" style="color: #3E5766;">List Category</div>
                                    <form class="form-search nav pull-right" style="margin-top: 2px;" name="search" onsubmit="return check_searchform();" action="" method="get">
                                        <input class="input-medium search-query" id="search_todaycontent" type="text" name="q" value="<?php echo isset($_GET['q']) ? trim($_GET['q']) : ''; ?>" />
                                        <button type="submit" class="btn">Search</button>
                                    </form>
                                </div>
                            </div>
                            <div class="bd-content">
                                <?php
                                include('../includes/pagination.inc');
                                $query_search = "";
                                $search = isset($_GET['q']) ? $_GET['q'] : '';
                                if ($search != "") {
                                    $arrq = explode(' ', trim($search));
                                    foreach ($arrq as $i => $q) {
                                        if ($i > 0) {
                                            $query_search .= " AND ";
                                        } else {
                                            $query_search .= " WHERE ";
                                        }
                                        $query_search .= " (`title` LIKE '%" . $q . "%' OR `id` LIKE '%" . $q . "%') ";
                                    }
                                    ?>
                                    <p style="padding: 7px 5px; background-color: #f6f6f6;">
                                        Search Category for : <strong><?php echo $search; ?></strong>
                                    </p>
                                    <?php
                                }
                                
                                $page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
                                $per_page = 20;
                                $page_index = $page > 0 ? ($page - 1) * $per_page : 0;
                                $i = ($per_page * ($page - 1)) + 1;

                                $allResult = $mysqli->query("SELECT * FROM `categories` WHERE 1") or die($mysqli->error);
                                $num_rows = $allResult->num_rows;

                                if ($num_rows > $per_page) {
                                    __pagination($num_rows, $per_page, $page, 0, $search);
                                }
                                ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50">No</th>
                                            <th>Title</th>
                                            <th width="50">Status</th>
                                            <th width="100">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($num_rows > 0) {
                                            $result = $mysqli->query("SELECT * FROM `categories` ORDER BY `id` DESC LIMIT $page_index, $per_page") or die($mysqli->error);
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['id'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $row['title'] ?></td>
                                                    <td>  
                                                        <?php if ($row['status'] == 0) { ?>
                                                            <a href="#" id="<?php echo $id . "-1" ?>" class="category" title="Unpublish" style="margin-left:15px;"><i class="icon-ban-circle"></i></a>
                                                        <?php } else { ?>
                                                            <a href="#" id="<?php echo $id . "-0" ?>" class="category" title="Publish" style="margin-left:15px;"><i class="icon-share"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="row-fluid">
                                                            <div class="span2"></div>
                                                            <div class="span4"><a href="saveCategory.php?edit=<?php echo $id ?>" title="Edit"><i class="icon-pencil"></i></a></div>
                                                            <div class="span4"><a class="delete"  href="saveCategory.php?delete=<?php echo $id ?>"><i class="icon-trash"></i></a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                if ($num_rows > $per_page) {
                                    __pagination($num_rows, $per_page, $page, 0, $search);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
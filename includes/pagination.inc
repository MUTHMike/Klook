<?php

function __pagination($nb_rows, $rows_per_page, $cur_page = 1, $cat, $search) {
    $page = "";
    if ($cat > 0) {
        $page = "&cat=$cat";
    }
    if ($search != "") {
        $page = "&q=$search";
    }


    $nbpages = intval($nb_rows / $rows_per_page);
    if ($nb_rows % $rows_per_page > 0) :
        $nbpages++;
    endif;

    echo '<ul id="pagination">';

    if ($cur_page == 1) :
        echo '<li class="disabled">&laquo; Previous</li>';
    else :
        echo '<li><a href="?page=' . ($cur_page - 1) . '' . $page . '">&laquo; Previous</a></li>';
    endif;


    if ($nbpages < 20) :

        for ($i = 1; $i <= $nbpages; $i++) :
            if ($i == $cur_page) :
                echo '<li><a href="?page=' . $i . '' . $page . '" class="current">' . $i . '</a></li>';
            else :
                echo '<li><a href="?page=' . $i . '' . $page . '">' . $i . '</a></li>';
            endif;
        endfor;

    else :

        if ($cur_page < 11) :

            for ($i = 1; $i < 13; $i++) :
                if ($i == $cur_page) :
                    echo '<li><a href="?page=' . $i . '' . $page . '" class="current">' . $i . '</a></li>';
                else :
                    echo '<li><a href="?page=' . $i . '' . $page . '">' . $i . '</a></li>';
                endif;
            endfor;
            echo '<li>...</li>';
            for ($i = $nbpages - 4; $i <= $nbpages; $i++) :
                echo '<li><a href="?page=' . $i . '' . $page . '">' . $i . '</a></li>';
            endfor;

        elseif ($cur_page > $nbpages - 10) :

            for ($i = 1; $i < 6; $i++) :
                echo '<li><a href="?page=' . $i . '' . $page . '">' . $i . '</a></li>';
            endfor;
            echo '<li>...</li>';
            for ($i = $nbpages - 11; $i <= $nbpages; $i++) :
                if ($i == $cur_page) :
                    echo '<li><a href="?page=' . $i . '' . $page . '" class="current">' . $i . '</a></li>';
                else :
                    echo '<li><a href="?page=' . $i . '' . $page . '">' . $i . '</a></li>';
                endif;
            endfor;

        else :

            for ($i = 1; $i < 6; $i++) :
                echo '<li><a href="?page=' . $i . '' . $page . '">' . $i . '</a></li>';
            endfor;
            echo '<li>...</li>';
            for ($i = $cur_page - 2; $i <= $cur_page + 2; $i++) :
                if ($i == $cur_page) :
                    echo '<li><a href="?page=' . $i . '' . $page . '" class="current">' . $i . '</a></li>';
                else :
                    echo '<li><a href="?page=' . $i . '' . $page . '">' . $i . '</a></li>';
                endif;
            endfor;
            echo '<li>...</li>';
            for ($i = $nbpages - 4; $i <= $nbpages; $i++) :
                echo '<li><a href="?page=' . $i . '' . $page . '">' . $i . '</a></li>';
            endfor;

        endif;

    endif;


    if ($cur_page == $nbpages) :
        echo '<li class="disabled">Next &raquo;</li>';
    else :
        echo '<li><a href="?page=' . ($cur_page + 1) . '' . $page . '">Next &raquo;</a></li>';
    endif;

    echo '</ul>';
}

?>
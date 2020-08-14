<?php

if (!function_exists('makePagination')) {
    /**
     * @param $pager array Matriz obtida do ORM, ou criado com os paramêtros necessários
     * @param $baseUrl String  Url Base da páginação
     * @param string $defaultParameter String nome do parametro GET da paginção, Default: p
     */
    function makePagination($pager, $baseUrl, $defaultParameter = "p"){

        ?>
        <ul class="pagination">
            <?php if ($pager['preview_page'] != null) { ?>
                <li class="page-item">
                    <a href="<?= base_url("{$baseUrl}?{$defaultParameter}={$pager['preview_page']}") . getQuery([$defaultParameter], true) ?>"
                       class="page-link">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php } ?>
            <?php for ($p = $pager['start_on']; $p <= $pager['end_on']; $p++) { ?>
                <li class="page-item <?php if ($p == $pager['page']) echo "active";?>"><a href="<?= base_url("{$baseUrl}?{$defaultParameter}={$p}") . getQuery([$defaultParameter], true) ?>"
                                         class="page-link"><?= $p ?></a></li>
            <?php } ?>
            <?php if ($pager['next_page'] != null) { ?>
                <li class="page-item">
                    <a href="<?= base_url("{$baseUrl}?{$defaultParameter}={$pager['next_page']}") . getQuery([$defaultParameter], true) ?>"
                       class="page-link">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <?php
    }
}
<?if(!empty($title)):?>
    <h1 class="title title_size_h1"><?=$title?></h1>
<?else:?>
    <h1 class="title title_size_h1">Список пользователей</h1>
<?endif;?>

<form action="/data/delete" method="post" class="js-ajax-sort-form">
    <!-- begin .table-->
    <table id="table" class="table">
        <thead class="table__head">
        <tr class="table__tr">
            <th class="table__th">
                <!-- begin .check-elem-->
                <div class="check-elem" title="Отметить все">
                    <input type="checkbox" id="check_all" class="check-elem__input check-elem__input_type_checkbox js-item-all-mark">
                    <label for="check_all" class="check-elem__label">Отметить все</label>
                </div>
                <!-- end .check-elem-->
            </th>
            <th class="table__th">ID</th>
            <th class="table__th">ФИО</th>
            <th class="table__th">Email</th>
            <th class="table__th">Адрес</th>
            <th class="table__th">Сортировка</th>
            <th class="table__th">&nbsp;</th>
        </tr>
        </thead>
        <tbody class="table__body">
        <?if(!empty($data)):?>
            <?foreach ($data as $item):?>
                <tr class="table__tr table__tr_<?=$item['id']?>" id="<?=$item['id']?>" data-id="<?=$item['id']?>" data-sort="<?=$item['sort']?>">
                    <td class="table__td">
                        <!-- begin .check-elem-->
                        <div class="check-elem" title="Отметить">
                            <input type="checkbox" id="check_<?=$item['id']?>" name="id[]" value="<?=$item['id']?>" class="check-elem__input check-elem__input_type_checkbox js-item-mark">
                            <label for="check_<?=$item['id']?>" class="check-elem__label">Отметить</label>
                        </div>
                        <!-- end .check-elem-->
                    </td>
                    <td class="table__td table__td_drag"><?=$item['id']?></td>
                    <td class="table__td table__td_drag"><?=$item['full_name']?></td>
                    <td class="table__td table__td_drag"><?=$item['email']?></td>
                    <td class="table__td table__td_drag"><?=$item['address']?></td>
                    <td class="table__td table__td_drag sort"><?=$item['sort']?></td>
                    <td class="table__td">
                        <a href="/data/edit?id=<?=$item['id']?>" class="button button_style_primary js-edit-entry">Изменить</a>
                    </td>
                </tr>
            <?endforeach?>
        <?else:?>
            <tr class="table__tr">
                <td colspan="7" class="table__td">Нет записей</td>
            </tr>
        <?endif?>
        </tbody>
        <tfoot class="table__foot">
        <tr class="table__tr">
            <td colspan="3" class="table__td">
                <button type="submit" class="button button_style_danger js-data-remove"  disabled>Удалить выбранное</button>
            </td>
            <td colspan="4" class="table__td table__td_align_right">
                <a href="data/add" class="button button_style_success js-data-add">Добавить пользователя</a>
            </td>
        </tr>
        </tfoot>
    </table>
    <!-- end .table-->
</form>

<div class="page__pagination">
    <?if(!empty($pagination)):?>
        <!-- begin .pagination-->
        <ul class="pagination">
            <?if(!empty($pagination['first']['value'])):?>
                <li class="pagination__item">
                    <a href="<?=$pagination['url']?><?=$pagination['first']['value']?>" class="pagination__link"><?=$pagination['first']['text']?></a>
                </li>
            <?endif;?>

            <?if(!empty($pagination['backward']['value'])):?>
                <li class="pagination__item">
                    <a href="<?=$pagination['url']?><?=$pagination['backward']['value']?>" class="pagination__link"><?=$pagination['backward']['text']?></a>
                </li>
            <?endif;?>

            <?if(!empty($pagination['prev']['value'])):?>
                <li class="pagination__item">
                    <a href="<?=$pagination['url']?><?=$pagination['prev']['value']?>" class="pagination__link"><?=$pagination['prev']['text']?></a>
                </li>
            <?endif;?>

            <?if(!empty($pagination['current']['text'])):?>
                <li class="pagination__item">
                    <span class="pagination__link pagination__link_state_active"><?=$pagination['current']['text']?></span>
                </li>
            <?endif;?>

            <?if(!empty($pagination['next']['value'])):?>
                <li class="pagination__item">
                    <a href="<?=$pagination['url']?><?=$pagination['next']['value']?>" class="pagination__link"><?=$pagination['next']['text']?></a>
                </li>
            <?endif;?>

            <?if(!empty($pagination['forward']['value'])):?>
                <li class="pagination__item">
                    <a href="<?=$pagination['url']?><?=$pagination['forward']['value']?>" class="pagination__link"><?=$pagination['forward']['text']?></a>
                </li>
            <?endif;?>

            <?if(!empty($pagination['last']['value'])):?>
                <li class="pagination__item">
                    <a href="<?=$pagination['url']?><?=$pagination['last']['value']?>" class="pagination__link"><?=$pagination['last']['text']?></a>
                </li>
            <?endif;?>
        </ul>
        <!-- end .pagination-->
    <?endif;?>
</div>

<div class="page__panel">
    <!-- begin .entry-form-->
    <div class="entry-form">
        <!-- begin .panel-->
        <div class="panel">
            <div class="panel__header">
                <?if(!empty($title)):?>
                    <h2 class="panel__title"><?=$title?></h2>
                <?endif?>
            </div>
            <!-- begin .form-->
            <form action="/data/<?=$action?>" method="post" class="form">
                <div class="grid-12__container">
                    <div class="grid-12__row">
                        <div class="grid-12__col grid-12__col_size_4">
                            <div class="form__line">
                                <label for="full_name" class="form__label">Имя:</label>
                                <input type="text" name="full_name" id="full_name" class="form__text" <?if(!empty($data['full_name'])):?>value="<?=$data['full_name']?>"<?endif;?>>
                            </div>
                        </div>
                        <div class="grid-12__col grid-12__col_size_4">
                            <div class="form__line">
                                <label for="email" class="form__label">E-mail:</label>
                                <input type="email" name="email" id="email" class="form__text" <?if(!empty($data['email'])):?>value="<?=$data['email']?>"<?endif;?>>
                            </div>
                        </div>
                        <div class="grid-12__col grid-12__col_size_4">
                            <div class="form__line">
                                <label for="sort" class="form__label">Сортировка:</label>
                                <input type="number" name="sort" id="sort" class="form__text" <?if(!empty($data['sort'])):?>value="<?=$data['sort']?>"<?endif;?>>
                            </div>
                        </div>
                    </div>
                    <div class="grid-12__row">
                        <div class="grid-12__col">
                            <div class="form__line">
                                <label for="address" class="form__label">Адрес:</label>
                                <textarea type="address" name="address" id="address" class="form__textarea"> <?if(!empty($data['address'])):?><?=$data['address']?><?endif;?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="grid-12__row">
                        <div class="grid-12__col">
                            <div class="form__controls">
                                <input type="submit" value="Сохранить" class="button">
                            </div>
                        </div>
                    </div>
                </div>
                <?if(!empty($data['id'])):?>
                    <input type="hidden" name="id" value="<?=$data['id']?>">
                <?endif;?>
            </form>
            <!-- end .form-->
        </div>
        <!-- end .panel-->
    </div>
    <!-- end .entry-form-->
</div>
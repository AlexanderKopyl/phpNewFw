<option value="<?= $id; ?>">
<?= $tab . $category['title']; ?>
<?php if (isset($category['childs'])) : ?>
    <?= $this->getMenuHtml($category['childs'],'&nbsp;'.$tab . '-') ?>
<?php endif; ?>
</option>
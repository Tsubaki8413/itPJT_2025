<?php

$csvFile = __DIR__ . '/assets/cards.csv';

if (!file_exists($csvFile)) {
    echo "CSVファイルが見つかりません。";
    return;
}

$cards = [];
$types = [];

if (($handle = fopen($csvFile, "r")) !== FALSE) {
    $header = fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== FALSE) {
        $card = array_combine($header, $data);
        $cards[] = $card;
        $types[] = $card['card_type'];
    }
    fclose($handle);
}

// 重複を除いたカードタイプ一覧
$types = array_unique($types);

?>

<?php foreach ($types as $index => $type): ?>
    <input type="radio" name="tab_name" id="tab<?= $index ?>" <?= $index === 0 ? 'checked' : '' ?>>
    <label class="tab_class" for="tab<?= $index ?>"><?= htmlspecialchars($type) ?></label>
    <div class="content_class">
        <?php foreach ($cards as $card): ?>
            <?php if ($card['card_type'] === $type): ?>
                <div class="img-contents">
                    <div class="tab-img">
                        <a href="#" class="popup_open" data-target="popup_<?= htmlspecialchars($card['card_id']) ?>">
                            <img src="images/cards/<?= htmlspecialchars(trim($card['card_img'])) ?>" alt="<?= htmlspecialchars($card['character_name']) ?>">
                        </a>
                    </div>

                    <div class="tab-btn">
                        <button type="button" class="addList"><img src="images/button/plus.png" alt="プラス"></button>
                        <button type="button" class="removeList"><img src="images/button/minus.png" alt="マイナス"></button>
                    </div>
                </div>

                <!-- ポップアップ本体 -->
                <div class="popup_content">
                    <div class="popup_box" id="popup_<?= htmlspecialchars($card['card_id']) ?>" data-index="<?= $index ?>">
                        <div class="popup">
                            <img src="images/cards/<?= htmlspecialchars(trim($card['card_img'])) ?>" alt="<?= htmlspecialchars($card['character_name']) ?>">

                            <div class="popup_text">
                                <ruby>
                                    <?= htmlspecialchars($card['character_name']) ?>
                                    <span><?= htmlspecialchars($card['card_number']) ?> | <?= htmlspecialchars($card['rarity']) ?></span>
                                </ruby>

                                <ul>
                                    <li>必要エナジー：<?= htmlspecialchars($card['required_enargy']) ?></li>
                                    <li>消費ＡＰ　　：<?= htmlspecialchars($card['ap']) ?></li>
                                    <li>特徴　　　　：<?= htmlspecialchars($card['affinity']) ?></li>
                                    <li>カード種別　：<?= htmlspecialchars($card['card_type']) ?></li>
                                    <li>ＢＰ　　　　：<?= htmlspecialchars($card['bp']) ?></li>
                                    <li>発生エナジー：<?= htmlspecialchars($card['generated_enargy']) ?></li>
                                    <li>トリガー　　：<?= htmlspecialchars($card['trigger']) ?></li>
                                </ul>

                                <h3>効果</h3>
                                <p><?= htmlspecialchars($card['effect']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
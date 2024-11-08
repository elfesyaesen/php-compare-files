<?php
function dosyalariKarsilastir($webYolu, $pcYolu)
{
    // Dosyaları okuyalım
    $web = file($webYolu, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $pc = file($pcYolu, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $farkliSatirlar = [];
    $maksSatirSayisi = max(count($web), count($pc)); // Uzun dosyayı bul

    // Satır satır karşılaştıralım
    for ($i = 0; $i < $maksSatirSayisi; $i++) {
        $satir1 = isset($web[$i]) ? $web[$i] : null;
        $satir2 = isset($pc[$i]) ? $pc[$i] : null;

        if ($satir1 !== $satir2) {
            $farkliSatirlar[] = [
                'satir_no' => $i + 1,
                'web' => $satir1,
                'pc' => $satir2
            ];
        }
    }

    return $farkliSatirlar;
}

// Dosya yollarını belirtelim
$webYolu = 'dosya1.text';
$pcYolu = 'dosya2.text';

// Dosyaları karşılaştıralım
$farkliSatirlar = dosyalariKarsilastir($webYolu, $pcYolu);

// Farklı satırları ekrana yazdıralım
if (!empty($farkliSatirlar)) {
    echo "Farklı satırlar bulundu:\n <br>";
    foreach ($farkliSatirlar as $fark) {
        echo "Satır " . $fark['satir_no'] . ":\n <br>";
        echo "Dosya 1: " . ($fark['web'] !== null ? $fark['web'] : "Boş satır") . "\n <br>";
        echo "Dosya 2: " . ($fark['pc'] !== null ? $fark['pc'] : "Boş satır") . "\n <br>";
        echo "---------------------\n <br>";
    }
} else {
    echo "Dosyalar tamamen aynı.";
}

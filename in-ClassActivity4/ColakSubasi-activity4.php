

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Java Jam Coffee House</title>
    <meta name="description" content="CENG 311 Inclass Activity 1" />
</head>
<body>
    <form action="ColakSubasi-activity4.php" method="GET">
        <p>sş</p>
        <table>
            <tr>
                <td>From:</td>
                <td><input type="text" name="fromAmount" value="<?php echo $fromAmount; ?>"></td>
                <td>Currency:</td>
                <td>
                    <select name="fromCurrency">
                        <option value="USD" <?php if($fromCurrency == "USD") echo "selected"; ?>>USD</option>
                        <option value="CAD" <?php if($fromCurrency == "CAD") echo "selected"; ?>>CAD</option>
                        <option value="EUR" <?php if($fromCurrency == "EUR") echo "selected"; ?>>EUR</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>To:</td>
                <td><input type="text" name="toAmount" value="<?php echo $convertedAmount; ?>" readonly></td>
                <td>Currency:</td>
                <td>
                    <select name="toCurrency">
                        <option value="USD" <?php if($toCurrency == "USD") echo "selected"; ?>>USD</option>
                        <option value="CAD" <?php if($toCurrency == "CAD") echo "selected"; ?>>CAD</option>
                        <option value="EUR" <?php if($toCurrency == "EUR") echo "selected"; ?>>EUR</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="submit" value="Convert"></td>
            </tr>
        </table>
    </form>

    <?php
// Get exchange rates
function getExchangeRates() {
    $exchangeRates = array(
        "USD_EUR" => 0.85, // USD to EUR dönüşüm oranı
        "EUR_USD" => 1.18, // EUR to USD dönüşüm oranı
        "USD_CAD" => 1.25, // USD to CAD dönüşüm oranı
        "CAD_USD" => 0.80, // CAD to USD dönüşüm oranı
        "EUR_CAD" => 1.47, // EUR to CAD dönüşüm oranı
        "CAD_EUR" => 0.68, // CAD to EUR dönüşüm oranı
    );
    return $exchangeRates;
}

// Calculate the converted amount
function convertCurrency($amount, $fromCurrency, $toCurrency) {
    $rates = getExchangeRates();
    $exchangeKey = $fromCurrency . "_" . $toCurrency;
    if (array_key_exists($exchangeKey, $rates)) {
        $convertedAmount = $amount * $rates[$exchangeKey];
        return number_format($convertedAmount, 2) . " " . $toCurrency; 
    } else {
        return "Can not find";
    }
}

// After the form is sent, take the entered value and place it back in the form
$fromAmount = isset($_GET["fromAmount"]) ? $_GET["fromAmount"] : "";
$fromCurrency = isset($_GET["fromCurrency"]) ? $_GET["fromCurrency"] : "USD"; // USD selected by default
$toCurrency = isset($_GET["toCurrency"]) ? $_GET["toCurrency"] : "USD"; // USD selected by default

if ($_SERVER["REQUEST_METHOD"] == "GET") {
     // If the form has been submitted, perform the conversion
     $convertedAmount = convertCurrency($fromAmount, $fromCurrency, $toCurrency);
} else {
     // If the form is not submitted, set the default converted amount
     $convertedAmount = "";
}
?>
</body>

</html>

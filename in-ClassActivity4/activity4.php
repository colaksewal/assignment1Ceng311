<!DOCTYPE html>
<html lang="en">
<head>
    <title>Java Jam Coffee House</title>
    <meta name="description" content="CENG 311 Inclass Activity 1" />
</head>
<body>
    <form action="activity4.php" method="GET">
        <table>
        <tr>
                <td>From:</td>
                <td><input type="text" name="fromAmount" value="<?php if(isset($_GET['fromAmount'])) echo $_GET['fromAmount']; ?>"></td>
                <td>Currency:</td>
                <td>
                    <select name="fromCurrency">
                        <option value="USD" <?php if(isset($_GET['fromCurrency']) && $_GET['fromCurrency'] == 'USD') echo 'selected'; ?>>USD</option>
                        <option value="CAD" <?php if(isset($_GET['fromCurrency']) && $_GET['fromCurrency'] == 'CAD') echo 'selected'; ?>>CAD</option>
                        <option value="EUR" <?php if(isset($_GET['fromCurrency']) && $_GET['fromCurrency'] == 'EUR') echo 'selected'; ?>>EUR</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>To:</td>
                <td><input type="text" name="toAmount" value="<?php if(isset($_GET['toAmount'])) echo $_GET['toAmount']; ?>" readonly></td>
                <td>Currency:</td>
                <td>
                    <select name="toCurrency">
                        <option value="USD" <?php if(isset($_GET['toCurrency']) && $_GET['toCurrency'] == 'USD') echo 'selected'; ?>>USD</option>
                        <option value="CAD" <?php if(isset($_GET['toCurrency']) && $_GET['toCurrency'] == 'CAD') echo 'selected'; ?>>CAD</option>
                        <option value="EUR" <?php if(isset($_GET['toCurrency']) && $_GET['toCurrency'] == 'EUR') echo 'selected'; ?>>EUR</option>
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
    // get exchange rates
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

    // Function to calculate the converted amount
    function convertCurrency($amount, $fromCurrency, $toCurrency) {
        $rates = getExchangeRates();
        $convertedAmount = $amount * $rates[$fromCurrency . "_" . $toCurrency];
        return $convertedAmount;
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["fromAmount"]) && isset($_GET["fromCurrency"]) && isset($_GET["toCurrency"])) {
        // Get form data
        $fromAmount = $_GET["fromAmount"];
        $fromCurrency = $_GET["fromCurrency"];
        $toCurrency = $_GET["toCurrency"];
        // Perform conversion
        $convertedAmount = convertCurrency($fromAmount, $fromCurrency, $toCurrency);
        // Display result in the input field
        echo "<script>document.getElementsByName('toAmount')[0].value = '{$convertedAmount} {$toCurrency}';</script>";
    }
    ?>
</body>
</html>

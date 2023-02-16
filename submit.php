<?php
if (isset($_POST['send'])) {
  // Get the form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Load the Google Sheets API library
  require_once __DIR__ . 'assets\vendor\autoload.php';

  // Authenticate with the Google Sheets API
  putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . 'assets\js\blissful-hash-337610-e2e3d621e636.json');
  $client = new Google_Client();
  $client->useApplicationDefaultCredentials();
  $client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);

  // Connect to the Google Sheet
  $service = new Google_Service_Sheets($client);
  $spreadsheetId = 'https://docs.google.com/spreadsheets/d/1BLARFUPNUqUXnvM9k4fb9n11fl38GRbWXLww3Iz94Mc';
  $range = 'Sheet1!A:C';

  // Get the last row in the Google Sheet
  $response = $service->spreadsheets_values->get($spreadsheetId, $range);
  $values = $response->getValues();
  $nextRow = count($values) + 1;

  // Write the form data to the Google Sheet
  $values = [
    [$name, $email, $message],
  ];
  $body = new Google_Service_Sheets_ValueRange([
    'values' => $values,
  ]);
  $params = [
    'valueInputOption' => 'RAW',
    'insertDataOption' => 'INSERT_ROWS',
  ];
  $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

  // Redirect to a thank-you page
  header('Location: #');
  exit;
}
?>

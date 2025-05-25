function doPost(e) {
  const spreadsheet = SpreadsheetApp.getActiveSpreadsheet(); // Active table
  const data = JSON.parse(e.postData.contents); // Get data from POST request
  
  const now = new Date();
  const month = now.getMonth() + 1; // Month (a number from 0 to 11, so we add 1)
  const currentYear = now.getFullYear(); // Get the year
  const sheetName = `${month}.${currentYear}`; // Format: "12.2024"
  
  // Check if a sheet with the current month exists
   let sheet = spreadsheet.getSheetByName(sheetName);
  
  // If the sheet doesn't exist, create it
  if (!sheet) {
    sheet = spreadsheet.insertSheet(sheetName);
    sheet.appendRow(['Datum', 'Jméno', 'Čas','Z odd.','Na odd.']); // Add headers
  }

  // Add data to the table
  data.forEach(row => {
    const date = new Date(); // Current date for each entry
    sheet.appendRow([date.toLocaleString(), ...row]); // Add the date to the first column
  });
  
  // Return the response
  return ContentService.createTextOutput("Data successfully added to the sheet");
}
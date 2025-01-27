document.addEventListener('DOMContentLoaded', function() {

    fetch('https://zugmaul-gutscheine.com/tekkhus-api/price_response.php')
        .then(response => response.text())
        .then(data => {
            const prices = data.split("|");
            document.getElementById('roc_p').innerText = prices[0];
            document.getElementById('sau_p').innerText = prices[1];
            document.getElementById('schar_p').innerText = prices[2];
        })
        .catch(error => console.error('Error:', error));



    // Sucht nach dem Button, der die Aktion auslösen soll
    var showButton_ro = document.getElementById('showButton_RO');
    var showButton_sa = document.getElementById('showButton_SA');
    var showButton_sc = document.getElementById('showButton_SC');
  
    // Überprüft, ob der Button existiert, um Fehler zu vermeiden
    if (showButton_ro) {
        showButton_ro.addEventListener('click', function(event) {
        event.preventDefault(); // Verhindert das Standardverhalten des Links
  
        // Ändert das Display-Attribut von Input und Button
        var myInput = document.getElementById('myInput_RO');
        var copyButton = document.getElementById('ro_button');
  
        if (myInput && copyButton) {
          myInput.style.display = 'block'; // Zeigt das Textfeld an
          copyButton.style.display = 'block'; // Zeigt den Button an
        }
      });
    }

    // Überprüft, ob der Button existiert, um Fehler zu vermeiden
    if (showButton_sa) {
        showButton_sa.addEventListener('click', function(event) {
          event.preventDefault(); // Verhindert das Standardverhalten des Links
    
          // Ändert das Display-Attribut von Input und Button
          var myInput = document.getElementById('myInput_SA');
          var copyButton = document.getElementById('sa_button');
    
          if (myInput && copyButton) {
            myInput.style.display = 'block'; // Zeigt das Textfeld an
            copyButton.style.display = 'block'; // Zeigt den Button an
          }
        });
      }

    // Überprüft, ob der Button existiert, um Fehler zu vermeiden
    if (showButton_sc) {
        showButton_sc.addEventListener('click', function(event) {
          event.preventDefault(); // Verhindert das Standardverhalten des Links
    
          // Ändert das Display-Attribut von Input und Button
          var myInput = document.getElementById('myInput_SC');
          var copyButton = document.getElementById('sc_button');
    
          if (myInput && copyButton) {
            myInput.style.display = 'block'; // Zeigt das Textfeld an
            copyButton.style.display = 'block'; // Zeigt den Button an
          }
        });
      }  


  });

  
  
  // Funktion, um den Text zu kopieren (muss im HTML definiert sein)
  function myFunction(inputID) {
    var copyText = document.getElementById(inputID);
    copyText.select(); // Selektiert den Text im Input
    document.execCommand("copy"); // Führt den Kopierbefehl aus
    //alert("Copied the text: " + copyText.value); // Zeigt eine Bestätigungsnachricht an
  }
  
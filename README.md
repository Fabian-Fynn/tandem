tandem
======
Refactoring:
1. Smell:
  Code Duplication,
  multipresent checks of Database connection
  
  Solution:
  Extracted to method 'checkDB()' in functions.php

2. Smell:
  Code Duplication,
  Check if logged in at multiple positions.
  
  Solution:
  Extracted to method 'checkSession()' in functions.php

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API Documentation</title>
  <!-- Redoc CDN -->
  <script src="https://cdn.jsdelivr.net/npm/redoc@next/bundles/redoc.standalone.js"></script>

  <!-- Swagger UI CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swagger-ui-dist@4/swagger-ui.css">
  <script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist@4/swagger-ui-bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist@4/swagger-ui-standalone-preset.js"></script>

  <style>
    /* Basic Reset */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .tab-container {
      display: flex;
      justify-content: center;
      background-color: #f4f4f4;
      border-bottom: 2px solid #ddd;
    }
    .tab-button {
      padding: 10px 20px;
      margin: 0;
      cursor: pointer;
      background-color: #fff;
      border: 1px solid #ddd;
      border-bottom: none;
      transition: background-color 0.3s ease;
    }
    .tab-button:hover {
      background-color: #ddd;
    }
    .tab-button.active {
      background-color: #007BFF;
      color: white;
    }
    .tab-content {
      padding: 20px;
      display: none;
    }
    .tab-content.active {
      display: block;
    }
    .additional-view {
      margin-top: 20px;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      padding: 20px;
    }
    .additional-view h2 {
      color: #333;
    }
  </style>
</head>
<body>

  <!-- Tab Navigation -->
  <div class="tab-container">
    <button class="tab-button active" onclick="showTab('documentation')">API Documentation</button>
    <button class="tab-button" onclick="showTab('swagger-ui')">Swagger UI</button>
  </div>

  <!-- Tab Content -->
  <div id="documentation" class="tab-content active">
    <div id="redoc-container"></div>
  </div>

  <div id="swagger-ui" class="tab-content">
    <div id="swagger-container"></div>
  </div>

  <script>
    // Initialize Redoc with the OpenAPI JSON URL
    Redoc.init('https://8000-idx-hai-1733797936307.cluster-mwrgkbggpvbq6tvtviraw2knqg.cloudworkstations.dev/openapi.json', {
      scrollYOffset: 50
    }, document.getElementById('redoc-container'));

    // Initialize Swagger UI with the OpenAPI JSON URL
    const ui = SwaggerUIBundle({
      url: 'https://8000-idx-hai-1733797936307.cluster-mwrgkbggpvbq6tvtviraw2knqg.cloudworkstations.dev/openapi.json',
      dom_id: '#swagger-container',
      deepLinking: true,
      presets: [
        SwaggerUIBundle.presets.apis,
      ],
      layout: "BaseLayout", // Change from StandaloneLayout to BaseLayout
      docExpansion: "none" // Optional: Add this for a cleaner UI, collapsing all the endpoints initially
    });

    // Function to switch tabs
    function showTab(tabId) {
      // Hide all tab contents
      const tabContents = document.querySelectorAll('.tab-content');
      tabContents.forEach(content => {
        content.classList.remove('active');
      });

      // Remove active class from all tab buttons
      const tabButtons = document.querySelectorAll('.tab-button');
      tabButtons.forEach(button => {
        button.classList.remove('active');
      });

      // Show the selected tab content
      document.getElementById(tabId).classList.add('active');
      
      // Add active class to the clicked tab button
      const activeButton = Array.from(tabButtons).find(button => button.textContent.toLowerCase() === tabId.replace('-', ' '));
      if (activeButton) activeButton.classList.add('active');
    }
  </script>

</body>
</html>

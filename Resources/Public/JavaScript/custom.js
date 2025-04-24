// console.log("my file download");

		
	

// // get autologin link API



// function fetchApiData(website_name) {



//   var packageType = "free-widget";
//   var arrDetails = {
//     'name': 'admin',
//     'email': 'ee@gmail.com',
//     'company_name': 'admin',
//     'website': website_name,
//     'package_type': packageType,
//     'start_date': new Date().toISOString(),
//     'end_date': '',
//     'price': '',
//     'discount_price': '0',
//     'platform': 'wordpress',
//     'api_key': '',
//     'is_trial_period': '',
//     'is_free_widget': '1',
//     'bill_address': '',
//     'country': '',
//     'state': '',
//     'city': '',
//     'post_code': '',
//     'transaction_id': '',
//     'subscr_id': '',
//     'payment_source': ''
//   };

//   console.log('Details to send:', arrDetails);

//   const apiUrl = "https://ada.skynettechnologies.us/api/get-autologin-link";
//   console.log("website url" + website_name);
//   // Prepare the POST request
//   fetch(apiUrl, {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json" // Specify the content type
//     },
//     body: JSON.stringify({ website: website_name }) // Pass the encoded domain name in the request body
//   })
//     .then(response => {
//       // Check if the response is okay (status code 200)
//       if (!response.ok) {
//         throw new Error(`HTTP error! status: ${response.status}`);
//       }
//       return response.json(); // Parse the JSON response
//     })
//     .then(result => {
//       // Log the result to check the response structure
//       console.log(result); // This will log the full response from the API

//       // Check if the response contains a valid link
//       if (result && result.link) {
//         console.log("Autologin Link:", result.link);  // Log the link
//       } else {
//         console.error("Invalid response or missing link.");
//         const secondApiUrl = "https://ada.skynettechnologies.us/api/add-user-domain";

//         // Send the details to the second API
//         fetch(secondApiUrl, {
//           method: "POST",
//           headers: {
//             "Content-Type": "application/json" // Specify the content type
//           },
//           body: JSON.stringify(arrDetails) // Pass the array data to the second API
//         })
//           .then(response => {
//             if (!response.ok) {
//               throw new Error(`HTTP error! Status: ${response.status}`);
//             }
//             return response.json();
//           })
//           .then(data => {
//             console.log("Response from add-user-domain API:", data);

//             // Handle the response from the add-user-domain API (success/failure)
//             if (data.success) {
//               console.log("User domain added successfully!");
//             } else {
//               console.error("Error adding user domain.");
//             }
//           })
//           .catch(error => {
//             console.error("Error sending data to add-user-domain API:", error);
//           });
//       }
//     })
//     .catch(error => {
//       console.error("Error fetching API:", error); // Log any errors
//     });
// }


// //end auto login api
// const defaultSettings = {
//   widget_position: "bottom_right",
//   widget_color_code: "#861818",
//   widget_icon_type: "aioa-icon-type-1",
//   widget_icon_size: "aioa-small-icon",
// };

// // Load settings from sessionStorage or cookies

// var domain_name = window.location.hostname;


// // var domain_name = document.getElementById('domain-list').options[0].text;
// var website_name = btoa(domain_name);
// console.log("Updated website_name: " + website_name);
// fetchApiResponse(domain_name);
// fetchApiData(website_name); // Fetch API response for the updated domain
// // Set the initial domain name and fetch API response on page load
// window.onload = function () {
  
//   console.log("Initial domain_name: " + domain_name);
//   website_name = btoa(domain_name);
//   console.log("Updated domain_name: " + domain_name);
//   fetchApiResponse(domain_name);
//   fetchApiData(website_name);
//   fetchSettings();
//   domain_name = window.location.hostname;
//   localhostdomain = window.location.hostname;
//   console.log("host name" + localhostdomain);
//   website_name = btoa(domain_name);
//   console.log("Updateddd domain_name: " + domain_name);
//   fetchApiResponse(domain_name);
//   fetchApiData(website_name); 
//   var server_name = window.location.hostname;
//   console.log("Initial server_name: " + server_name);// Fetch API response for the updated domain
//   // Fetch initial response for the default domain
// };

// // Function to update the domain name on dropdown change


// // Function to fetch API response using POST
// function fetchApiResponse(domain_name) {
//   const apiUrl = "https://ada.skynettechnologies.us/api/widget-settings";

//   fetch(apiUrl, {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json" // Specify the content type
//     },
//     body: JSON.stringify({ website_url: domain_name }) // Pass the domain name in the request body
//   })
//     .then(response => {
//       if (!response.ok) {
//         throw new Error(`HTTP error! status: ${response.status}`);
//       }
//       return response.json(); // Parse the JSON response
//     })
//     .then((result) => {
//       // Check if result and result.Data are valid
//       if (result && result.Data && Object.keys(result.Data).length > 0) {
//         console.log("Widget settings fetched:", result.Data);
//         const settings = {
//           widget_position: result.Data.widget_position || defaultSettings.widget_position,
//           widget_color_code: result.Data.widget_color_code || defaultSettings.widget_color_code,
//           widget_icon_type: result.Data.widget_icon_type || defaultSettings.widget_icon_type,
//           widget_icon_size: result.Data.widget_icon_size || defaultSettings.widget_icon_size,
//           widget_size: result.Data.widget_size || defaultSettings.widget_size,
//           widget_icon_size_custom: result.Data.widget_icon_size_custom || defaultSettings.widget_icon_size_custom,
//           widget_position_top: result.Data.widget_position_top || 0,
//           widget_position_bottom: result.Data.widget_position_bottom || 0,
//           widget_position_left: result.Data.widget_position_left || 0,
//           widget_position_right: result.Data.widget_position_right || 0,
//         };

//         console.log("Fetched settings:", settings);

//         populateSettings(settings);
//         // You can process the settings here or pass them to another function
//       } else {
//         console.log("API returned 0 or no data. Loading settings from session or cookies.");
//         console.error("Invalid API response, using fallback settings.");

//       }
//     })
//     .catch(error => {
//       console.error("Error fetching API:", error);
//       // Handle error scenarios like invalid response or network issues
//     });
// }
// function fetchSettings() {
//   const requestOptions = {
//     method: "POST",
//     redirect: "follow"
//   };

//   fetch(`https://ada.skynettechnologies.us/api/widget-settings?website_url=${domain_name}`, requestOptions)
//     .then((response) => {
//       if (!response.ok) {
//         throw new Error("Network response was not ok");
//       }
//       return response.json(); // Parse JSON response
//     })
//     .then((result) => {
//       // Check if result and result.Data are valid
//       if (result && result.Data && Object.keys(result.Data).length > 0) {
//         console.log("Widget settings fetched:", result.Data);
//       } else {
//         console.log("API returned 0 or no data. Loading settings from session or cookies.");
//       }
//     })
//     .catch((error) => {
//       console.error("Error fetching widget settings:", error);
//       alert("Failed to fetch settings. Using default values.");
//       populateSettings(defaultSettings);
//     });


// }

// // Populate form fields with settings
// function populateSettings(settings) {
//   const colorField = document.getElementById("colorcode");
//   if (colorField) {
//     colorField.value = settings.widget_color_code;
//   }
//   const typeOptions = document.querySelectorAll('input[name="aioa_icon_type"]');
//   typeOptions.forEach((option) => {
//     if (option.value === settings.widget_icon_type) {
//       option.checked = true;
//     }
//   });

//   const sizeOptions = document.querySelectorAll('input[name="aioa_icon_size"]');
//   sizeOptions.forEach((option) => {
//     if (option.value === settings.widget_icon_size) {
//       option.checked = true;
//     }
//   });

//   const iconImg = `https://www.skynettechnologies.com/sites/default/files/${settings.widget_icon_type}.svg`;
//   $(".iconimg").attr("src", iconImg);
//   console.log("Icon updated to:", iconImg);
//   const widget_icon_size_custom = document.getElementById("widget_icon_size_custom");
//   if (widget_icon_size_custom) {
//     widget_icon_size_custom.value = settings.widget_icon_size_custom;
//   }
//   const positionRadio = document.querySelector(`input[name="position"][value="${settings.widget_position}"]`);
//   if (positionRadio) {
//     positionRadio.checked = true;
//   }
//   const widget_size = document.querySelector(`input[name="widget_size"][value="${settings.widget_size}"]`);
//   if (widget_size) {
//     widget_size.checked = true;
//   }

//   // Set custom position fields
//   const customPositionXField = document.getElementById("custom_position_x_value");

//   const xDirectionSelect = document.querySelector(".custom-position-controls select:nth-child(1)");

//   if (customPositionXField && xDirectionSelect) {
//     if (settings.widget_position_right > 0) {
//       customPositionXField.value = settings.widget_position_right;
//       xDirectionSelect.value = "cust-pos-to-the-right";
//     } else if (settings.widget_position_left > 0) {
//       customPositionXField.value = settings.widget_position_left;
//       xDirectionSelect.value = "cust-pos-to-the-left";
//     } else {
//       customPositionXField.value = 0;
//       xDirectionSelect.value = "cust-pos-to-the-right"; // Default direction
//     }
//   }
//   console.log("Setting x position - left:", settings.widget_position_left, "right:", settings.widget_position_right);
//   console.log("Custom Position X Value:", customPositionXField.value);
//   console.log("X Direction Select Value:", xDirectionSelect.value);
//   const customPositionYField = document.getElementById("custom_position_y_value");

//   const yDirectionSelect = document.querySelector(".custom-position-controls select:nth-child(2)");

//   if (customPositionYField && yDirectionSelect) {
//     if (settings.widget_position_bottom > 0) {
//       customPositionYField.value = settings.widget_position_bottom;
//       yDirectionSelect.value = "cust-pos-to-the-lower";
//     } else if (settings.widget_position_top > 0) {
//       customPositionYField.value = settings.widget_position_top;
//       yDirectionSelect.value = "cust-pos-to-the-upper";
//     } else {
//       customPositionYField.value = 0;
//       yDirectionSelect.value = "cust-pos-to-the-lower"; // Default direction
//     }
//   }
//   console.log("Setting y position - upper:", settings.widget_position_top, "lower:", settings.widget_position_bottom);
//   console.log("Custom Position Y Value:", customPositionYField.value);
//   console.log("Y Direction Select Value:", yDirectionSelect.value);

// }

// // Fetch settings when the page loads


// $(document).ready(function () {

//   // Custom Switchers
//   $("#custom-position-switcher").click(function () {
//     $(".custom-position-controls").toggleClass("hide");
//     $(".widget-position").toggleClass("hide");

//   });
//   $("#custom-size-switcher").click(function () {
//     $(".custom-size-controls").toggleClass("hide");
//     $(".widget-icon").toggleClass("hide");
//   });
// });

// const sizeOptions = document.querySelectorAll('input[name="aioa_icon_size"]');
// const sizeOptionsImg = document.querySelectorAll('input[name="aioa_icon_size"] + label img');
// const typeOptions = document.querySelectorAll('input[name="aioa_icon_type"]');
// const positionOptions = document.querySelectorAll('input[name="position"]');
// const custSizePreview = document.querySelector(".custom-size-preview img");
// const custSizePreviewLabel = document.querySelector(".custom-size-preview .value span");

// // Set default value to custom position inputs
// var positions = {
//   top_left: [20, 20],
//   middel_left: [20, 50],
//   bottom_center: [50, 20],
//   top_center: [50, 20],
//   middel_right: [20, 50],
//   bottom_right: [20, 20],
//   top_right: [20, 20],
//   bottom_left: [20, 20],
// };
// positionOptions.forEach((option) => {
//   var ico_position = document.querySelector('input[name="position"]:checked').value;
//   document.getElementById("custom_position_x_value").value = positions[ico_position][0];
//   document.getElementById("custom_position_y_value").value = positions[ico_position][1];
//   option.addEventListener("click", (event) => {
//     var ico_position = document.querySelector('input[name="position"]:checked').value;
//     document.getElementById("custom_position_x_value").value = positions[ico_position][0];
//     document.getElementById("custom_position_y_value").value = positions[ico_position][1];
//   });
// });

// // Set icon on type select
// typeOptions.forEach((option) => {
//   option.addEventListener("click", (event) => {
//     var ico_type = document.querySelector('input[name="aioa_icon_type"]:checked').value;
//     sizeOptionsImg.forEach((option2) => {
//       option2.setAttribute("src", "https://www.skynettechnologies.com/sites/default/files/" + ico_type + ".svg");
//     });
//     custSizePreview.setAttribute("src", "https://www.skynettechnologies.com/sites/default/files/" + ico_type + ".svg");
//   });
// });

// // Set icon on size select
// sizeOptions.forEach((option) => {
//   var ico_size_value = document
//     .querySelector('input[name="aioa_icon_size"]:checked + label img')
//     .getAttribute("width");
//   // Set default value to custom size input
//   const widget_icon_size_custom = document.getElementById("widget_icon_size_custom");
//   document.getElementById("widget_icon_size_custom").value = widget_icon_size_custom;
//   console.log("Set default value to custom size input" + widget_icon_size_custom)
//   custSizePreviewLabel.innerHTML = ico_size_value;
//   option.addEventListener("click", (event) => {
//     var ico_width = document
//       .querySelector('input[name="aioa_icon_size"]:checked + label img')
//       .getAttribute("width");
//     var ico_height = document
//       .querySelector('input[name="aioa_icon_size"]:checked + label img')
//       .getAttribute("height");
//     custSizePreview.setAttribute("width", ico_width);
//     custSizePreview.setAttribute("height", ico_height);
//     document.getElementById("widget_icon_size_custom").value = ico_width;
//     custSizePreviewLabel.innerHTML = ico_width;
//   });
// });

// // Set icons size on input change
// document.getElementById("widget_icon_size_custom").addEventListener("input", function () {
//   var ico_size_value = document.getElementById("widget_icon_size_custom").value;
//   if (ico_size_value >= 20 && ico_size_value <= 150) {
//     custSizePreview.setAttribute("width", ico_size_value);
//     custSizePreview.setAttribute("height", ico_size_value);
//     custSizePreviewLabel.innerHTML = ico_size_value;
//   }
//   if (ico_size_value < 20) {
//     custSizePreview.setAttribute("width", 20);
//     custSizePreview.setAttribute("height", 20);
//     custSizePreviewLabel.innerHTML = 20;
//   }
//   if (ico_size_value > 150) {
//     custSizePreview.setAttribute("width", 150);
//     custSizePreview.setAttribute("height", 150);
//     custSizePreviewLabel.innerHTML = 150;
//   }
// });




// document.addEventListener('DOMContentLoaded', function () {
//   fetch('https://www.skynettechnologies.com/add-ons/discount_offer.php?platform=typo3') // Replace with your API endpoint
//     .then(response => response.text())
//     .then(data => {
//       document.getElementById('api-response').innerHTML = data;
//     })
//     .catch(error => {
//       console.error('Error fetching data:', error);
//     });
// });




// $('input[name="position"]').change(function () {
//   var icon_position = document.querySelector('input[name="position"]:checked').value;
// });

// $('input[name="aioa_icon_type"]').change(function () {
//   var icon_type = document.querySelector('input[name="aioa_icon_type"]:checked').value;
// });
// $('input[name="aioa_icon_size"]').change(function () {
//   var icon_size = document.querySelector('input[name="aioa_icon_size"]:checked').value;
// });

// var website_dropdown_form_id = $("#domain-list").val();
// var e = document.getElementById("domain-list");
// var value = e.value;
// var website_dropdown_name = e.options[e.selectedIndex].text;
// var license_key = $("#license_key").val();
// if (license_key == "") {
//   license_key = "license_key";
// }
// var colorcode = $("#colorcode").val();
// if (colorcode == "") {
//   colorcode = "420083";
// }
// var icon_position = document.querySelector('input[name="position"]:checked').value;
// var icon_type = document.querySelector('input[name="aioa_icon_type"]:checked').value;
// var icon_size = document.querySelector('input[name="aioa_icon_size"]:checked').value;

// $('#license_key,#colorcode').change(function () {
//   var license_key = $("#license_key").val();
//   var colorcode = $("#colorcode").val();
//   //var checkedValue = $('.messageCheckbox:checked').val();
// })
// $('input[name="position"]').change(function () {
//   var icon_position = document.querySelector('input[name="position"]:checked').value;
// });


// $('input[name="aioa_icon_type"]').change(function () {
//   var icon_type = document.querySelector('input[name="aioa_icon_type"]:checked').value;

// });
// $('input[name="aioa_icon_size"]').change(function () {
//   var icon_size = document.querySelector('input[name="aioa_icon_size"]:checked').value;

// });

// // Set the initial server name and display it

// // Function to update the server name on dropdown change

// function f1() {
//   var server_name = window.location.hostname;
//   console.log("Initial server_name nmmm: " + server_name);
//   // Update settings
//   var colorcode = $("#colorcode").val();
//   var icon_position = document.querySelector('input[name="position"]:checked').value;
//   var icon_type = document.querySelector('input[name="aioa_icon_type"]:checked').value;
//   var icon_size = document.querySelector('input[name="aioa_icon_size"]:checked').value;
//   var widget_size = document.querySelector('input[name="widget_size"]:checked').value;
//   var widget_icon_size_custom = $("#widget_icon_size_custom").val();

//   const custom_position_x = $("#custom_position_x_value").val() || 0; // Default to 0 if no value
//   const custom_position_y = $("#custom_position_y_value").val() || 0;
//   const x_position_direction = $(".custom-position-controls select").eq(0).val();
//   const y_position_direction = $(".custom-position-controls select").eq(1).val();

//   // Initialize widget position values
//   let widget_position_right = null;
//   let widget_position_left = null;
//   let widget_position_top = null;
//   let widget_position_bottom = null;

//   // Update widget position based on the selected directions
//   if (x_position_direction === "cust-pos-to-the-right") {
//     widget_position_right = custom_position_x;
//   } else if (x_position_direction === "cust-pos-to-the-left") {
//     widget_position_left = custom_position_x;
//   }

//   if (y_position_direction === "cust-pos-to-the-lower") {
//     widget_position_bottom = custom_position_y;
//   } else if (y_position_direction === "cust-pos-to-the-upper") {
//     widget_position_top = custom_position_y;
//   }



//   console.log(colorcode, icon_position, icon_type, icon_size, widget_position_right,
//     widget_position_left,
//     widget_position_top,
//     widget_position_bottom,);

//   var url = 'https://ada.skynettechnologies.us/api/widget-setting-update-platform';

//   var params = `u=${server_name}&widget_position=${icon_position}&widget_color_code=${colorcode}&widget_icon_type=${icon_type}&widget_icon_size=${icon_size}&widget_size=${widget_size}&widget_icon_size_custom=${widget_icon_size_custom}&widget_position_right=${widget_position_right}&widget_position_left=${widget_position_left}&widget_position_top=${widget_position_top}&widget_position_bottom=${widget_position_bottom}`;

//   // Create the request
//   var xhr = new XMLHttpRequest();
//   xhr.open('POST', url, true);
//   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

//   xhr.onload = function () {
//     if (xhr.status === 200) {
//       alert('Settings updated successfully!');
//       console.log('Response:', xhr.responseText);
//     } else {
//       alert('Error: Unable to update settings. Please try again.');
//       console.error('Error:', xhr.statusText);
//     }
//   };

//   xhr.onerror = function () {
//     alert('Request failed. Please check your network connection.');
//   };

//   // Send the request with parameters
//   xhr.send(params);
// }





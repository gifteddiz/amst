#!/usr/bin/env node

// Initial setup for WP installation (moving config files, inserting site url...)
const readlineSync = require("readline-sync");
const fs = require("fs");

const siteUrl = readlineSync.question("Site URL: ");
const dbName = readlineSync.question("Database name: ");
const dbUser = readlineSync.question("Database user: ");
const dbPassword = readlineSync.question("Database password: ");

// Copying config files with string replacement
fs.copyFileSync("./setup/wp-config.sample.php", "../../../wp-config.php");
console.log("SUCCESS: wp-config copied;");

fs.readFile("./setup/.env.example", "utf8", function(err, data) {
  if (err) {
    return console.log(err);
  }
  var result = data
    .replace(/%%siteUrl%%/g, siteUrl)
    .replace(/%%dbName%%/g, dbName)
    .replace(/%%dbUser%%/g, dbUser)
    .replace(/%%dbPassword%%/g, dbPassword);

  fs.writeFile("../../../.env", result, "utf8", function(err) {
    if (err) return console.log(err);
  });
  console.log("SUCCESS: .env copied;");
});

fs.readFile("./setup/webpack.sample.mix.js", "utf8", function(err, data) {
  if (err) {
    return console.log(err);
  }
  var result = data.replace(/%%siteUrl%%/g, siteUrl);

  fs.writeFile("webpack.mix.js", result, "utf8", function(err) {
    if (err) return console.log(err);
    console.log("SUCCESS: webpack.mix.js copied;");
  });
});

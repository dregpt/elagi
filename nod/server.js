const express = require("express");

const app = express();

const bodyParser = require("body-parser");
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

const cors = require('cors');
app.use(cors());

/* Initializing the main project folder */
 app.use(express.static('public_html'));


// creat a local server:

const port = 8000;
const server = app.listen(port, listenning);

function listenning(){
    console.log(`Running server port: $(port)`);
}

"use strict";

const $ = selector => document.querySelector(selector);

const focusElement = selector => $(selector).focus();

const main = () => {
    focusElement("#username");

    document.addEventListener("keydown", e => {
        if (e.key == "Enter") {
            if (document.activeElement == $("#username")) {
                e.preventDefault();
                focusElement("#password");
            }
        }
    })
}

addEventListener("DOMContentLoaded", main);

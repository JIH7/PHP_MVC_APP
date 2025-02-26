"use strict";

const $ = selector => document.querySelector(selector);
const $all = selector => document.querySelectorAll(selector);
const focusElement = selector => $(selector).focus();

let inputs = []

const main = () => {
    focusElement("#email");
    inputs = Array.from($all("input[type='text'], input[type='email'], input[type='password']"));

    const errorLocation = $("#err-cursor");
    if (errorLocation) {
        inputs[parseInt(errorLocation.dataset.loc)].select();
    }

    addEventListener("keydown", e => {
        if (e.key == "Enter") {
            if (inputs.includes(document.activeElement)) {
                let emptyInputs = inputs.filter(input => input.value=="");

                if (emptyInputs.length == 0)
                    return;

                e.preventDefault();
                let focusTarget = inputs.indexOf(emptyInputs[0]);

                emptyInputs.every(input => {
                    if (inputs.indexOf(input) > inputs.indexOf(document.activeElement)) {
                        focusTarget = inputs.indexOf(input);
                        return false;
                    }
                    return true;
                });
                inputs[focusTarget].focus();
            }
        }
    });
};

addEventListener("DOMContentLoaded", main);
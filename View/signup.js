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
            if (inputs.includes(document.activeElement) && inputs[inputs.length-1] != document.activeElement) {
                e.preventDefault();
                nextInput = inputs[inputs.indexOf(document.activeElement)+1];
                if (nextInput.value == "")
                    nextInput.focus();
                else
                    nextInput.select();
            }
        }
    });
};

addEventListener("DOMContentLoaded", main);
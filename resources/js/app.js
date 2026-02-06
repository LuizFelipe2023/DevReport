import './bootstrap';
import * as bootstrap from 'bootstrap'; 
window.bootstrap = bootstrap;


import Choices from 'choices.js';
window.Choices = Choices;

import flatpickr from "flatpickr";
window.flatpickr = flatpickr; 
import { Portuguese } from "flatpickr/dist/l10n/pt.js";
flatpickr.localize(Portuguese);

import "flatpickr/dist/flatpickr.min.css";

import 'choices.js/public/assets/styles/choices.min.css';
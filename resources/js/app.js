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

import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

FilePond.registerPlugin(FilePondPluginImagePreview);

window.FilePond = FilePond; 

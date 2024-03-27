import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["active"];
    activeElement = this.activeTarget;
    clickedElement = this.activeTarget;

    initialize() {
        document.addEventListener('turbo:before-stream-render', () => {
            if (this.activeElement != this.clickedElement) {
                this.activeElement.classList.toggle('active');
                this.clickedElement.classList.toggle('active');
                this.activeElement = this.clickedElement;
            }
        })
    }

    navLinkClick(event) {
        this.clickedElement = event.currentTarget;
    }
}
class FadeSlider {
    carouselParent;
    carouselItems;
    prev;
    next;
    carouselIndicators;

    autoSlide = true;

    autoSlideVar;

    activeInd = 0;

    initialOpac = 1;
    draggingOpac = 1;
    siblingOpac = 0;
    slideExt;

    constructor(carouselParent, config) {
        this.carouselParent = carouselParent;
        this.autoSlide = config.autoSlide;
        this.ngAfterViewInit();
    }

    ngOnDestroy() {
        if (isPlatformBrowser(this.platformId)) {
            this.windowResponsive(false);
        }
    }

    ngAfterViewInit() {
        // this.flexCont = this.carouselParent.querySelector(".flexCont");
        this.carouselItems = this.carouselParent.querySelectorAll(".slideItem");
        this.prev = this.carouselParent.querySelector(".prev");
        this.next = this.carouselParent.querySelector(".next");
        this.carouselIndicators =
            this.carouselParent.querySelectorAll(".indicatorItem");
        if (this.carouselItems.length > 1) {
            this.initiateCarousel();
        }
    }

    responsive() {
        this.slideExt = +getComputedStyle(this.carouselItems[0]).width.replace(
            "px",
            ""
        );
    }

    windowResponsive(add) {
        const me = this;
        if (add) {
            window.addEventListener("resize", resize);
            document.addEventListener("visibilitychange", visibilityCheck);
        } else {
            window.removeEventListener("resize", resize);
            document.removeEventListener("visibilitychange", visibilityCheck);
        }

        function resize() {
            me.responsive();
        }

        function visibilityCheck() {
            if (this.autoSlide) {
                document.visibilityState == "hidden" ?
                    me.stopAutoSlide() :
                    me.startAutoSlide();
            }
        }
    }

    initiateCarousel() {
        // if (this.infiniteSlide) {
        //     this.carouselItems.forEach((carouselItem) => {
        //         let cloned = carouselItem.cloneNode(true);
        //         this.flexCont.appendChild(cloned);
        //     });
        // }
        this.windowResponsive(true);
        this.responsive();
        this.initiateEventBinding();
    }

    initiateEventBinding() {
        const me = this;

        function slide() {
            me.slide(1);
        }

        function dragStart(e) {
            me.dragStart(e);
        }

        function startAutoSlide() {
            me.startAutoSlide();
        }

        function stopAutoSlide() {
            me.stopAutoSlide();
        }

        function negSlide() {
            me.slide(-1);
        }

        function indSelect(e, i) {
            me.indicatorSelect(e, i);
        }
        this.next.onclick = slide;
        this.prev.onclick = negSlide;

        this.draggable = true;
        this.carouselParent.onmousedown = dragStart;
        this.carouselParent.ontouchstart = dragStart;
        this.carouselParent.onmouseenter = stopAutoSlide;
        if (this.autoSlide) {
            this.carouselParent.onmouseleave = startAutoSlide;
        }

        if (this.autoSlide) {
            this.startAutoSlide();
        }
        if (this.carouselIndicators) {
            this.carouselIndicators.forEach((indicator, i) => {
                indicator.onclick = (e) => {
                    indSelect(e, i);
                };
                indicator.ontouchstart = (e) => {
                    indSelect(e, i);
                };
            });
        }
    }

    startAutoSlide() {
        this.stopAutoSlide();
        this.autoSlideVar = setInterval(() => this.slide(1), 5000);
    }

    stopAutoSlide() {
        clearInterval(this.autoSlideVar);
    }

    indicatorSelect(e, I) {
        e.stopPropagation();
        if (I == this.activeInd) return;
        this.activeInd = I;
        this.fadeSlide();
        this.checkIndicators();
    }

    fadeSlide() {
        this.carouselItems.forEach((each, i) => {
            if (i == this.activeInd) {
                each.classList.add("activeSlide");
            } else {
                each.classList.remove("activeSlide");
            }
        });
    }

    slide(n) {
        this.activeInd += n;
        if (this.activeInd == this.carouselItems.length) {
            this.activeInd = 0;
        } else if (this.activeInd < 0) {
            this.activeInd = this.carouselItems.length - 1;
        }
        this.fadeSlide();
        if (this.carouselIndicators) {
            this.setIndicators();
        }
    }

    setIndicators() {
        this.carouselIndicators.forEach((indicator, i) => {
            if (i != this.activeInd) {
                indicator.classList.remove("cusActive");
            } else {
                indicator.classList.add("cusActive");
            }
        });
    }

    dragging = false;

    dragStart(e) {
        const me = this;
        if (e.type == "mousedown") {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        }
        this.carouselItems.forEach((each) => {
            each.style.transition = "0s";
        });
        this.carouselParent.style.cursor = "grab";
        this.initialXPos = e.type == "mousedown" ? e.x : e.touches[0].clientX;
        this.dragMovHandler = drag;
        this.dragEndHandler = dragStop;

        document.addEventListener("mousemove", drag);
        document.addEventListener("touchmove", drag);
        document.addEventListener("mouseup", dragStop);
        document.addEventListener("touchend", dragStop);

        if (e.type == "touchstart") {
            this.stopAutoSlide();
        }

        function drag(ev) {
            me.drag(ev);
        }

        function dragStop(ev) {
            me.dragStop(ev);
        }
    }

    // sibling;
    siblingInd;
    dir = 0;

    drag(e) {
        this.stopAutoSlide();
        let curXPos = e.type == "mousemove" ? e.x : e.touches[0].clientX;
        let diff = curXPos - this.initialXPos;
        this.initialXPos = curXPos;
        let actDiff = diff / this.slideExt;
        let finalOp = this.draggingOpac;
        if (!this.dragging) {
            if (diff > 0) {
                this.siblingInd = !this.activeInd ?
                    this.carouselItems.length - 1 :
                    this.activeInd - 1;
                this.dir = -1;
            } else {
                this.siblingInd =
                    this.activeInd == this.carouselItems.length - 1 ?
                    0 :
                    this.activeInd + 1;
                this.dir = 1;
            }

            finalOp = this.draggingOpac - actDiff;
            this.siblingOpac += actDiff;
            this.dragging = true;
        } else {
            finalOp = this.draggingOpac + actDiff * this.dir;
            this.siblingOpac -= actDiff * this.dir;
            if (this.dir < 0) {
                if (finalOp < 0) {
                    finalOp = 1;
                    this.siblingOpac = 0;
                    this.activeInd =
                        this.activeInd - 1 < 0 ?
                        this.carouselItems.length - 1 :
                        this.activeInd - 1;
                    this.siblingInd = !this.activeInd ?
                        this.carouselItems.length - 1 :
                        this.activeInd - 1;
                    this.setIndicators();
                    this.dragging = false;
                } else if (finalOp > 1) {
                    finalOp = 1;
                    this.siblingOpac = 0;
                    this.dragging = false;
                }
            } else if (this.dir > 0) {
                if (finalOp < 0) {
                    finalOp = 1;
                    this.siblingOpac = 0;
                    this.activeInd =
                        this.activeInd + 1 == this.carouselItems.length ?
                        0 :
                        this.activeInd + 1;
                    this.siblingInd =
                        this.activeInd == this.carouselItems.length - 1 ?
                        0 :
                        this.activeInd + 1;
                    this.setIndicators();
                    this.dragging = false;
                } else if (finalOp > 1) {
                    finalOp = 1;
                    this.siblingOpac = 0;
                    this.dragging = false;
                }
            }
        }
        this.draggingOpac = finalOp;
        console.log(this.siblingInd);
        if (this.siblingInd != undefined) {
            let sibling = this.carouselItems[this.siblingInd];
            sibling.style.opacity = `${this.siblingOpac}`;
        }
        this.carouselItems[this.activeInd].style.opacity = `${finalOp}`;
    }

    dragStop(e) {
        this.dragging = false;
        this.carouselParent.style.cursor = "default";
        document.removeEventListener('mousemove', this.dragMovHandler);
        document.removeEventListener('touchmove', this.dragMovHandler);
        document.removeEventListener('mouseup', this.dragEndHandler);
        document.removeEventListener('touchend', this.dragEndHandler);

        this.activeInd = this.siblingInd;

        this.carouselItems.forEach(each => {
            each.style.transition = "";
        });
        this.fadeSlide();
        this.setIndicators();
        this.carouselItems.forEach(each => {
            each.style.opacity = "";
        });
        this.draggingOpac = 1;
        this.siblingOpac = 0;
    }

    checkIndicators() {
        if (this.carouselIndicators) {
            this.setIndicators();
        }
    }
}
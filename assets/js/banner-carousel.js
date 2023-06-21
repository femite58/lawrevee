class BannerCarousel {
    carouselParent;
    flexCont;
    carouselItems;
    prev;
    next;
    carouselIndicators;

    initialSlidePos;
    initialXPos;
    draggingPos;
    slideExt;
    flexW;
    floorExt = 0;
    parW;
    draggable = false;

    autoSlide = true;
    infiniteSlide = true;

    dragMovHandler;
    dragEndHandler;

    autoSlideVar;

    sliding = false;

    activeInd = 0;

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
        this.flexCont = this.carouselParent.querySelector(".flexCont");
        this.carouselItems = this.flexCont.querySelectorAll(".carouselItem");
        this.prev = this.carouselParent.querySelector(".carouselCtrlPrev");
        this.next = this.carouselParent.querySelector(".carouselCtrlNext");
        this.carouselIndicators =
            this.carouselParent.querySelectorAll(".indicatorItem");
        if (this.carouselItems.length > 1) {
            this.initiateCarousel();
        }
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
        if (this.infiniteSlide) {
            this.carouselItems.forEach((carouselItem) => {
                let cloned = carouselItem.cloneNode(true);
                this.flexCont.appendChild(cloned);
            });
        }
        this.windowResponsive(true);
        this.responsive();
        this.initiateEventBinding();
    }

    responsive() {
        this.parW = +getComputedStyle(this.carouselParent).width.replace("px", "");
        let pl = +getComputedStyle(this.carouselParent).paddingLeft.replace(
            "px",
            ""
        );
        let pr = +getComputedStyle(this.carouselParent).paddingRight.replace(
            "px",
            ""
        );
        this.parW = this.parW - pl - pr;
        this.carouselItems = this.flexCont.querySelectorAll(".carouselItem");
        this.carouselItems.forEach((carouselItem) => {
            carouselItem.style.width = `${this.parW}px`;
        });
        this.slideExt = +this.carouselItems[0].style.width.replace("px", "");
        this.flexW = this.carouselItems.length * this.parW;
        this.flexCont.style.width = `${this.flexW}px`;
        this.initialSlidePos = this.parW * this.activeInd * -1;
        this.draggingPos = this.initialSlidePos;
        this.flexCont.style.transition = "0s";
        this.flexCont.style.left = `${this.initialSlidePos}px`;
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
        this.next.addEventListener("click", slide);
        this.prev.addEventListener("click", negSlide);

        this.draggable = true;
        this.carouselParent.onmousedown = dragStart;
        this.carouselParent.ontouchstart = dragStart;
        this.carouselParent.onmouseenter = stopAutoSlide;
        if (this.draggable && this.autoSlide) {
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
        this.flexCont.style.transition = "0s";
        this.initialSlidePos = this.parW * this.activeInd * -1;
        this.flexCont.style.left = `${this.initialSlidePos}px`;
        this.activeInd = I;
        this.initialSlidePos = this.parW * this.activeInd * -1;
        this.draggingPos = this.initialSlidePos;
        this.checkIndicators();
        setTimeout(() => {
            this.flexCont.style.transition = "0.6s ease";
            this.flexCont.style.left = `${this.initialSlidePos}px`;
        });
    }

    slide(n) {
        if (this.sliding) return;
        this.sliding = true;
        let finalPos = +(this.initialSlidePos - n * this.slideExt);
        let middlePos = (this.flexW / 2) * -1;
        if (!this.infiniteSlide) {
            if (
                (+finalPos.toFixed(0) > 0 && n == -1) ||
                (+finalPos.toFixed(0) <
                    +(this.slideExt * (this.carouselItems.length - 1) * -1).toFixed(0) &&
                    n == 1)
            )
                return;
        }
        if (
            (+finalPos.toFixed(0) > 0 && n == -1) ||
            (+finalPos.toFixed(0) <
                +(this.slideExt * (this.carouselItems.length - 1) * -1).toFixed(0) &&
                n == 1)
        ) {
            this.flexCont.style.transition = "0s";
            let resetPos;
            if (finalPos > 0 && n == -1) {
                resetPos = middlePos;
            }
            if (finalPos < this.slideExt * (this.carouselItems.length - 1) * -1) {
                resetPos = middlePos + this.slideExt;
            }
            this.flexCont.style.left = `${resetPos}px`;
            finalPos = resetPos - n * this.slideExt;
        }
        this.initialSlidePos = finalPos;
        this.draggingPos = this.initialSlidePos;
        this.activeInd += n;
        if (this.activeInd > this.carouselItems.length / 2 - 1) {
            this.activeInd = 0;
        }
        if (this.activeInd < 0) {
            this.activeInd = this.carouselItems.length / 2 - 1;
        }
        if (this.carouselIndicators) {
            this.setIndicators();
        }
        setTimeout(() => {
            this.flexCont.style.transition = "0.6s ease";
            this.flexCont.style.left = `${finalPos}px`;
            this.sliding = false;
        }, 10);
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

    dragStart(e) {
        const me = this;
        if (e.type == "mousedown") {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        }
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

        function drag(e) {
            me.drag(e);
        }

        function dragStop(e) {
            me.dragStop(e);
        }
    }

    drag(e) {
        let curXPos = e.type == "mousemove" ? e.x : e.touches[0].clientX;
        let diff = curXPos - this.initialXPos;
        this.flexCont.style.transition = "0s";
        this.initialXPos = curXPos;
        let middlePos = (this.flexW / 2) * -1;
        let finalPos = this.draggingPos + diff;
        let slideExt;
        if (this.initialSlidePos > this.draggingPos) {
            slideExt = this.initialSlidePos - this.draggingPos;
            if (
                Math.floor(slideExt / this.slideExt) >= 1 &&
                this.floorExt != Math.floor(slideExt / this.slideExt)
            ) {
                this.activeInd += Math.floor(slideExt / this.slideExt) - this.floorExt;
                this.floorExt = Math.floor(slideExt / this.slideExt);
            }
        } else if (this.initialSlidePos < this.draggingPos) {
            slideExt = this.draggingPos - this.initialSlidePos;
            if (
                Math.floor(slideExt / this.slideExt) >= 1 &&
                this.floorExt != Math.floor(slideExt / this.slideExt)
            ) {
                this.activeInd -= Math.floor(slideExt / this.slideExt) - this.floorExt;
                this.floorExt = Math.floor(slideExt / this.slideExt);
            }
        }
        if (slideExt) {
            this.checkIndicators();
        }
        if (
            (finalPos > 0 && diff > 0) ||
            (finalPos < this.slideExt * (this.carouselItems.length - 1) * -1 &&
                diff < 0)
        ) {
            let resetPos;
            if (finalPos > 0 && diff > 0) {
                resetPos = middlePos;
            }
            if (
                finalPos < this.slideExt * (this.carouselItems.length - 1) * -1 &&
                diff < 0
            ) {
                resetPos = middlePos + this.slideExt;
            }
            if (this.infiniteSlide) {
                this.flexCont.style.left = `${resetPos}px`;
                finalPos = resetPos + diff;
                this.initialSlidePos = resetPos;
                this.floorExt = 0;
            } else {
                finalPos = this.draggingPos + diff * 0.1;
            }
        }
        this.draggingPos = finalPos;
        this.flexCont.style.left = `${finalPos}px`;
    }

    dragStop(e) {
        // e.stopImmediatePropagation();
        // e.stopPropagation();
        // e.preventDefault();
        const me = this;
        this.carouselParent.style.cursor = "default";
        document.removeEventListener("mousemove", me.dragMovHandler);
        document.removeEventListener("touchmove", me.dragMovHandler);
        document.removeEventListener("mouseup", me.dragEndHandler);
        document.removeEventListener("touchend", me.dragEndHandler);

        let rawDiff =
            this.initialSlidePos > this.draggingPos ?
            this.initialSlidePos - this.draggingPos :
            this.draggingPos - this.initialSlidePos;
        let realDiff = rawDiff % this.slideExt;
        let slideRem = this.slideExt - realDiff;
        let isA = false;
        let path = e.path || e.composedPath();
        for (let i = 0; i < path.length - 2; i++) {
            if (path[i].tagName == "A" && path[i].href != "javascript:void(0)") {
                isA = true;
            }
        }
        let curInd = this.activeInd;
        if (this.initialSlidePos > this.draggingPos) {
            if (isA) {
                e.target.onclick = (s) => {
                    s.preventDefault();
                    s.stopPropagation();
                };
            }
            let finalPos;
            if (realDiff > 0.2 * this.slideExt) {
                this.flexCont.style.transition = "0.3s ease";
                finalPos = this.draggingPos - slideRem;
                this.activeInd++;
            } else {
                finalPos = this.draggingPos + realDiff;
                this.flexCont.style.transition = "0.3s ease";
            }
            if (!this.infiniteSlide) {
                if (
                    this.draggingPos <
                    this.slideExt * (this.carouselItems.length - 1) * -1
                ) {
                    this.flexCont.style.transition = "0.3s ease";
                    finalPos = this.slideExt * (this.carouselItems.length - 1) * -1;
                    this.activeInd = curInd != this.activeInd ? curInd : this.activeInd;
                }
            }
            this.flexCont.style.left = `${finalPos}px`;
            this.draggingPos = finalPos;
            this.initialSlidePos = finalPos;
            this.floorExt = 0; //reset floorExt
        } else if (this.initialSlidePos < this.draggingPos) {
            if (isA) {
                e.target.onclick = (s) => {
                    s.preventDefault();
                    s.stopPropagation();
                };
            }
            let finalPos;
            if (realDiff > 0.2 * this.slideExt) {
                this.flexCont.style.transition = "0.3s ease";
                finalPos = this.draggingPos + slideRem;
                this.activeInd--;
            } else {
                finalPos = this.draggingPos - realDiff;
                this.flexCont.style.transition = "0.3s ease";
            }
            if (!this.infiniteSlide) {
                if (this.draggingPos > 0) {
                    this.flexCont.style.transition = "0.3s ease";
                    finalPos = 0;
                    this.activeInd = curInd != this.activeInd ? curInd : this.activeInd;
                }
            }
            this.flexCont.style.left = `${finalPos}px`;
            this.draggingPos = finalPos;
            this.initialSlidePos = finalPos;
            this.floorExt = 0; //reset floorExt
        } else {
            if (isA) {
                e.target.onclick = null;
            }
        }
        this.checkIndicators();
        if (e.type == "touchend" && this.autoSlide) {
            this.startAutoSlide();
        }
    }

    checkIndicators() {
        if (
            this.activeInd >
            this.carouselItems.length / (this.infiniteSlide ? 2 : 1) - 1
        ) {
            this.activeInd = 0;
        }
        if (this.activeInd < 0) {
            this.activeInd =
                this.carouselItems.length / (this.infiniteSlide ? 2 : 1) - 1;
        }
        if (this.carouselIndicators) {
            this.setIndicators();
        }
    }
}
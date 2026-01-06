export default () => ({
    mobileMenuOpen: false,

    scrollTo(target) {
        const el = document.querySelector(target)
        if (!el) return

        const offset =
            el.getBoundingClientRect().top +
            window.pageYOffset -
            this.$el.offsetHeight

        window.scrollTo({
            top: offset,
            behavior: 'smooth'
        })
    }
})

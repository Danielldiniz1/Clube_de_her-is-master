document.addEventListener('DOMContentLoaded', function() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const faq = this.parentElement;
            
            // Fecha todas as outras FAQs
            document.querySelectorAll('.faq.active').forEach(activeFaq => {
                if (activeFaq !== faq) {
                    activeFaq.classList.remove('active');
                }
            });
            
            // Alterna o estado da FAQ atual
            faq.classList.toggle('active');
        });
    });
});
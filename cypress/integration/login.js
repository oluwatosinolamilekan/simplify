it('Logs in users', () => {
    cy.create('App\\Models\\User').then(user => {
        let correctEmail = user.email;
        let correctPassword = 'password';
        let incorrectEmail = 'random@email.com';
        let incorrectPassword = 'random';
        cy.visit('/login');

        cy.get('input[name="email"]').clear();
        cy.get('input[name="password"]').clear();
        cy.get('button[type="submit"]').click();
        cy.get('input:invalid').should('have.length', 2)
        cy.get('input[name="email"]').then(($input) => {
            expect($input[0].validationMessage).to.eq('Please fill out this field.')
        })
        cy.location('pathname').should('eq','/login');

        cy.get('input[name="email"]').type(correctEmail);
        cy.get('button[type="submit"]').click();
        cy.get('input:invalid').should('have.length', 1)
        cy.get('input[name="password"]').then(($input) => {
            expect($input[0].validationMessage).to.eq('Please fill out this field.')
        })
        cy.location('pathname').should('eq','/login');
        cy.get('input[name="email"]').clear();

        cy.userLogin({email: correctEmail , password: '   '})
        cy.errorMessageLogin('The password field is required.')
        cy.get('input[name="email"]').clear();

        cy.userLogin({email: incorrectEmail, password: incorrectPassword})
        cy.errorMessageLogin('These credentials do not match our records.')
        cy.get('input[name="email"]').clear();

        cy.userLogin({email: incorrectEmail , password: correctPassword})
        cy.errorMessageLogin('These credentials do not match our records.')
        cy.get('input[name="email"]').clear();

        cy.userLogin({email: correctEmail , password: incorrectPassword})
        cy.errorMessageLogin('These credentials do not match our records.')
        cy.get('input[name="email"]').clear();

        cy.userLogin({email: correctEmail , password: correctPassword})
        cy.location('pathname').should('eq', '/');
    });
});

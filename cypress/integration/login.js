it('Logs in users', () => {
    cy.create('App\\Models\\User').then(user => {
        let correctEmail = user.email;
        let correctPassword = 'password';
        let incorrectEmail = 'random@email.com';
        let incorrectPassword = 'random';
        cy.visit('/login');

        cy.userLogin({email: '    ', password: '    '})
        cy.location('pathname').should('eq', '/login');

        cy.userLogin({email: correctEmail , password: '    '})
        cy.location('pathname').should('eq', '/login');
        cy.get('input[name="email"]').clear();

        cy.userLogin({email: incorrectEmail, password: incorrectPassword})
        cy.get('input[name="email"]').clear();
        cy.location('pathname').should('eq', '/login');

        cy.userLogin({email: incorrectEmail , password: correctPassword})
        cy.location('pathname').should('eq', '/login');
        cy.get('input[name="email"]').clear();

        cy.userLogin({email: correctEmail , password: incorrectPassword})
        cy.location('pathname').should('eq', '/login');
        cy.get('input[name="email"]').clear();

        cy.userLogin({email: correctEmail , password: correctPassword})
        cy.location('pathname').should('eq', '/');
    });
});

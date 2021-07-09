it('Logs out users', () => {
    cy.create('App\\Models\\User').then(user => {
        cy.visit('/login');
        cy.typeLogin({email: user.email , password: 'password'});

        cy.location('pathname').should('eq', '/');
        cy.Logout(user);
        cy.go(-1)
        cy.location('pathname').should('eq', '/login');
    });
});

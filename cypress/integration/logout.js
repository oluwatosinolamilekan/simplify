it('Logs out users', () => {
    cy.create('App\\Models\\User').then(user => {
        cy.visit('/login');
        // login
        cy.userLogin(user);

        cy.location('pathname').should('eq', '/');

        cy.contains(user.first_name);

        // logout
        cy.get('#manage_profile_icon').click({force: true});
        cy.get('#dropdown_logout').click();

        cy.location('pathname').should('eq', '/login');


    });
});

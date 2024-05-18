var orejimeConfig = {
    elementID: "orejime", // Identifiant de l'élément où Orejime sera initialisé
    appElement: "#app", // Élément contenant votre application (optionnel mais recommandé)

    cookieName: "orejime", // Nom du cookie utilisé par Orejime
    cookieExpiresAfterDays: 365, // Durée d'expiration du cookie en jours
    cookieDomain: 'mydomain.com', // Domaine personnalisé pour le cookie
    stringifyCookie: (contents) => JSON.stringify(contents), // Fonction pour sérialiser le contenu du cookie
    parseCookie: (cookie) => JSON.parse(cookie), // Fonction pour désérialiser le contenu du cookie

    privacyPolicy: "/your-privacy-policy-url", // Lien vers votre politique de confidentialité

    default: true, // Si les applications sont activées par défaut
    mustConsent: false, // Si l'utilisateur doit consentir explicitement
    mustNotice: false, // Si l'utilisateur doit être informé avant de consentir

    lang: "en", // Langue de l'interface utilisateur

    logo: false, // URL de l'image à afficher dans l'avis

    debug: false, // Mode débogage

    translations: {
        en: { // Traductions pour la langue anglaise
            consentModal: {
                description: "This is an example of how to override an existing translation already used by Orejime",
            },
            inlineTracker: {
                description: "Example of an inline tracking script",
            },
            externalTracker: {
                description: "Example of an external tracking script",
            },
            purposes: {
                analytics: "Analytics",
                security: "Security"
            },
            categories: {
                analytics: {
                    description: "A long form description of the category."
                }
            }
        },
    },

    apps: [ // Liste des applications tiers gérées par Orejime
        {
            name: "google-tag-manager", // Nom de l'application
            title: "Google Tag Manager", // Titre affiché dans le modal de consentement
            cookies: [ // Liste des cookies définis par l'application
                "_ga",
                "_gat",
                "_gid",
                "__utma",
                "__utmb",
                "__utmc",
                "__utmt",
                "__utmz",
                "_gat_gtag_" + GTM_UA,
                "_gat_" + GTM_UA
            ],
            purposes: ["analytics"], // But(s) de l'application
            // Autres options comme callback, required, optOut, default, onlyOnce...
        },
        {
            name: "inline-tracker",
            title: "Inline Tracker",
            cookies: [
                "inline-tracker"
                // Vous pouvez spécifier des chemins et des domaines pour les cookies
            ],
            purposes: ["analytics"],
        },
        {
            name: "external-tracker",
            title: "External Tracker",
            cookies: ["external-tracker"],
            purposes: ["analytics", "security"],
            required: true // Exemple d'application requise
        }
    ],

    categories: [ // Catégories d'applications
        {
            name: "analytics",
            title: "Analytics",
            apps: [
                "google-tag-manager",
                "external-tracker"
            ]
        }
    ]
};

// Initialiser Orejime automatiquement
Orejime.init(orejimeConfig);
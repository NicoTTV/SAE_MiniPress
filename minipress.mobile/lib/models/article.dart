class Article {
  String titre;
  String dateCreation;
  String auteur;

  Article({
    required this.titre,
    required this.dateCreation,
    required this.auteur
  });

  factory Article.fromJson(Map<String, dynamic> json) {
    return Article(
      titre: json['titre'],
      dateCreation: json['date_de_creation'],
      auteur: json['id_user']
    );
  }
}


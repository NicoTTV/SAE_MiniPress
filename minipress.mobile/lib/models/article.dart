class Article {
  final String titre;
  final String dateCreation;
  final String auteur;
  final lienDetails;

  Article({
    required this.titre,
    required this.dateCreation,
    required this.auteur,
    this.lienDetails
  });

  factory Article.fromJson(Map<String, dynamic> json) {
    return Article(
      titre: json['titre'],
      dateCreation: json['date_de_creation'],
      auteur: json['id_user'],
      lienDetails: json['links']
    );
  }
}


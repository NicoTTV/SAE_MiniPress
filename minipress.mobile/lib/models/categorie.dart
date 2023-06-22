class Categorie {
  final String idCategorie;
  final String titre;
  final String description;

  Categorie({
    required this.idCategorie,
    required this.titre,
    required this.description
  });

  factory Categorie.fromJson(Map<String, dynamic> json) {
    return Categorie(
      idCategorie: json['id_categorie'],
      titre: json['titre'],
      description: json['description']
    );
  }
}
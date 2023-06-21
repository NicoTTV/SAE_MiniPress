import 'dart:convert';
import 'package:http/http.dart' as http;
import 'categorie.dart';

class CategProvider {

  Future<List<Categorie>> fetchCateg() async {
    var response = await http.get(
        Uri.parse('http://docketu.iutnc.univ-lorraine.fr:41004/api/categories'));

    List<Categorie> categoriesList = List.empty(growable: true);

    if (response.statusCode == 200) {
      var categoriesJson = json.decode(response.body);

      for (var i in categoriesJson) {
        categoriesList.add(Categorie.fromJson(i));
      }
    }

    return Future<List<Categorie>>.value(categoriesList);
  }
}

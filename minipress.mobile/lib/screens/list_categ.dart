import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:minipress_mobile/models/categorie.dart';
import '../models/categ_provider.dart';
import 'categ_preview.dart';

class ListCateg extends StatefulWidget {
  const ListCateg({super.key});

  @override
  State<ListCateg> createState() => _ListCateg();
}

class _ListCateg extends State<ListCateg> {
  late final Categorie categorie;
  List<Categorie> listCateg = <Categorie>[];

  @override
  Widget build(BuildContext context) {
    var categProvider = CategProvider();
    return FutureBuilder(
        future: categProvider.fetchCateg(),
        builder: ((context, snapshot) {
          if (snapshot.hasData) {
            return Container(
              decoration: const BoxDecoration(
                color: Color(0xFFE9F1FA),
                boxShadow: [
                  BoxShadow(
                      color: Color.fromARGB(70, 0, 0, 0),
                      spreadRadius: 1,
                      blurRadius: 10)
                ],
              ),
              child: ListView.builder(
                scrollDirection: Axis.horizontal,
                itemCount: snapshot.data?.length,
                itemBuilder: (context, index) {
                  // print(snapshot.data![index].titre);
                  return CategPreview(categorie: snapshot.data![index]);
                },
              ),
            );
          } else {
            return const Center(child: CircularProgressIndicator());
          }
        }));
  }
}

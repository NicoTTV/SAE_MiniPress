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
            return ListView.builder(
              scrollDirection: Axis.horizontal,
              itemCount: snapshot.data?.length,
              itemBuilder: (context, index) {
                // print(snapshot.data![index].titre);
                return CategPreview(categorie: snapshot.data![index]);
              },
            );
          } else {
              return const Center(child: CircularProgressIndicator());
          }
        }
      )
    );
  }
}